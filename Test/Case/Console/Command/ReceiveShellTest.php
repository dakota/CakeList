<?php

App::uses('ShellDispatcher', 'Console');
App::uses('ReceiveShell', 'Console/Command');

/**
 * TestMessageShell
 *
 */
class ReceiveShellTest extends CakeTestCase {

	public $message = <<<MESSAGE
From testguy@example.com Wed Aug 28 00:00:00 2013
Return-Path: <testguy@example.com>
Content-Type: text/plain; charset=utf-8;
MIME-Version: 1.0
From: "Test Guy" <testguy@example.com>
Subject: Test Message
To: lists@example.com
x-original-to: test@example.com
Reply-To: test@example.com
Date: Wed, 28 Aug 2013 00:00:00 +1200 (NZST)
Content-Transfer-Encoding: 8bit

Scouting is not an abstruse or difficult science:
	rather it is a jolly game if you take it in the right light.
	In the same time it is educative, and (like Mercy) it is apt 
	to benefit him that giveth as well as him that receives
                -- Baden-Powell
MESSAGE;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.domain',
		'app.mail_list',
		'app.moderation_queue',
		'app.archived_message',
		'app.member',
		'app.mail_lists_member'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$out = $this->getMock('ConsoleOutput', array(), array(), '', false);
		$in = $this->getMock('ConsoleInput', array(), array(), '', false);

		$this->Shell = $this->getMock(
			'ReceiveShell',
			array('in', 'out', 'hr', 'createFile', 'error', 'err', '_stop', '_showInfo'),
			array($out, $out, $in));
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Dispatcher, $this->Shell);
	}

/**
 * testReadMessageNoOriginalTo method
 *
 * @expectedException ReceiveException
 * @return void
 */
	public function testReadMessageNoOriginalTo() {
		$message = $this->message;
		$message = str_replace("x-original-to: test@example.com\n", '', $message);
		$this->Shell->receive($message);
	}

/**
 * testReadMessageIncorrectMailList method
 *
 * @expectedException ReceiveException
 * @return void
 */
	public function testReadMessageIncorrectMailList() {
		$message = $this->message;
		$message = str_replace('test@example.com', 'test2@example.com', $message);
		$this->Shell->receive($message);
	}

/**
 * testReadMessageFromNonMember method
 *
 * @expectedException ReceiveException
 * @return void
 */
	public function testReadMessageFromNonMember() {
		$message = $this->message;
		$message = str_replace('testguy@example.com', 'testman@example.com', $message);
		$this->Shell->receive($message);
	}

/**
 * testReadMessageValid method
 *
 * @return void
 */
	public function testReadMessageValid() {
		$this->Shell->receive($this->message);

		$message = ClassRegistry::init('ModerationQueue')->find('first');
		$this->assertEqual($message['ModerationQueue']['mail_list_id'], '52f892d2-0d08-4c82-b685-4377f6570d8e');
		$this->assertEqual($message['ModerationQueue']['message'], $this->message);
	}

	public function testMain() {
		$temp = fopen('php://temp', 'r+');
		fwrite($temp, $this->message);
		rewind($temp);
		$this->Shell->inputStream = $temp;
		$this->Shell->main();

		$message = ClassRegistry::init('ModerationQueue')->find('first');
		$this->assertEqual($message['ModerationQueue']['mail_list_id'], '52f892d2-0d08-4c82-b685-4377f6570d8e');
		$this->assertEqual($message['ModerationQueue']['message'], $this->message);
	}
}
