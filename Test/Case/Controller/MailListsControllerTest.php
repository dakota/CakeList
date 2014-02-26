<?php
App::uses('MailListsController', 'Controller');

/**
 * MailListsController Test Case
 *
 */
class MailListsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mail_list',
		'app.domain',
		'app.moderation_queue',
		'app.archived_message',
		'app.member',
		'app.mail_lists_member'
	);

/**
 * testView method
 *
 * @expectedException NotFoundException
 * @return void
 */
	public function testViewNoList() {
		$this->testAction('/mail_lists/view', array(
			'return' => 'vars'
		));
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$mailList = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$this->testAction('/mail_lists/view/' . $mailList, array(
			'return' => 'vars'
		));

		$this->assertEquals($this->vars['mailList']['MailList']['id'], $mailList);
		$this->assertCount(2, $this->vars['mailList']['Member']);
		$this->assertCount(1, $this->vars['mailList']['ModerationQueue']);
	}

/**
 * testAdd method
 *
 * @expectedException NotFoundException
 * @return void
 */
	public function testAddNoDomain() {
		$this->testAction('/mail_lists/add', array(
			'return' => 'vars'
		));
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$domainId = '52f8928d-6588-4f6f-ab87-430ef6570d8e';
		$this->testAction('/mail_lists/add/' . $domainId, array(
			'return' => 'vars',
			'method' => 'get'
		));
		$this->assertEquals($this->vars['domain']['Domain']['id'], $domainId);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAddPost() {
		$domainId = '52f8928d-6588-4f6f-ab87-430ef6570d8e';
		$MailLists = $this->generate('MailLists', array(
			'models' => array(
				'MailList' => array('save')
			)
		));
		$MailLists->MailList
			->expects($this->once())
			->method('save')
				->with(array(
					'MailList' => array(
						'domain_id' => $domainId,
						'address' => 'test2',
						'name' => 'Test 2'
					)
				));

		$this->testAction('/mail_lists/add/' . $domainId, array(
			'data' => array(
				'MailList' => array(
					'address' => 'test2',
					'name' => 'Test 2'
				),
			),
			'return' => 'vars',
			'method' => 'post'
		));
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
