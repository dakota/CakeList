<?php
App::uses('ModerationQueue', 'Model');

class MockProxy { // This thing could use a better name.

	private static $__mock;

	public static function setStaticExpectations($mock) {
		self::$__mock = $mock;
	}

	public static function __callStatic($name, $args) {
		return call_user_func_array(
			array(self::$__mock, $name), $args
		);
	}

}

class MockCakeResque extends MockProxy {
}

/**
 * ModerationQueue Test Case
 *
 */
class ModerationQueueTest extends CakeTestCase {

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
		'app.member',
		'app.mail_list',
		'app.domain',
		'app.moderation_queue',
		'app.archived_message',
		'app.mail_lists_member'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ModerationQueue = ClassRegistry::init('ModerationQueue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ModerationQueue);

		parent::tearDown();
	}

	public function testSaveMessageNonExist() {
		$result = $this->ModerationQueue->saveMessage($this->message, 'not-exist');
		$this->assertFalse($result);
	}

	public function testSaveMessage() {
		$result = $this->ModerationQueue->saveMessage($this->message, '52f892d2-0d08-4c82-b685-4377f6570d8e');
		$this->assertTrue(!empty($result));

		$message = $this->ModerationQueue->find('first');
		$this->assertEqual($message['ModerationQueue']['message'], $this->message);
	}

	public function testApproveMessageNotExist() {
		$this->assertFalse($this->ModerationQueue->approve('none'));
	}

	public function testApproveMessage() {
		$mock = $this->getMock('MockCakeResque', array('enqueue'));
		$mock->expects($this->once())
			->method('enqueue')
			->with('mail', 'MailShell')
			->will($this->returnValue(true));

		MockCakeResque::setStaticExpectations($mock);

		$this->ModerationQueue->queueClass = 'MockCakeResque';

		$this->ModerationQueue->approve('mail-test');
		$messages = $this->ModerationQueue->find('count');
		$this->assertEqual($messages, 0);
	}
}