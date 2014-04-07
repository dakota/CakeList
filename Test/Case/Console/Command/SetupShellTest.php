<?php

App::uses('ShellDispatcher', 'Console');
App::uses('SetupShell', 'Console/Command');
App::uses('Folder', 'Utility');

class SetupShellTest extends CakeTestCase {

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
			'SetupShell',
			array('in', 'out', 'hr', 'createFile', 'error', 'err', '_stop', '_showInfo'),
			array($out, $out, $in));
		$this->Shell->params['path'] = APP . 'Test' . DS . 'Postfix';
		$this->Shell->params['connection'] = 'test';
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Dispatcher, $this->Shell);
		$dir = new Folder(APP . 'Test' . DS . 'Postfix');
		$dir->delete();
	}

/**
 * Setup should exit with a friendly warning if Postfix is not used as the MTA
 */
	public function testSetupNotPostfix() {
		$this->Shell->expects($this->once())
			->method('in')
			->with('Do you use Postfix as your MTA?')
			->will($this->returnValue('n'));

		$this->Shell->expects($this->once())
			->method('_stop')
			->with(1);

		$this->Shell->expects($this->at(1))
			->method('out')
			->with('<warning>CakeList currently only supports Postfix</warning>');

		$this->Shell->main();
	}

	public function testSetup() {
		$this->Shell->expects($this->at(0))
			->method('in')
			->will($this->returnValue('y'));

		$this->Shell->main();
	}
}