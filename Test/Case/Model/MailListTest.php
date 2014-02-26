<?php
App::uses('MailList', 'Model');

/**
 * MailList Test Case
 *
 */
class MailListTest extends CakeTestCase {

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
		$this->MailList = ClassRegistry::init('MailList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MailList);

		parent::tearDown();
	}

	public function testValidList() {
		//Valid list
		$result = $this->MailList->getList('test@example.com');
		$this->assertEqual($result['MailList']['id'], '52f892d2-0d08-4c82-b685-4377f6570d8e');
		$this->assertCount(2, $result['Member']);

		//Invalid list, valid domain
		$result = $this->MailList->getList('invalid@example.com');
		$this->assertFalse($result);

		//Invalid domain
		$result = $this->MailList->getList('test@incorrect.com');
		$this->assertFalse($result);
	}

}
