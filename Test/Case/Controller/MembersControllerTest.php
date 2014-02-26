<?php
App::uses('MembersController', 'Controller');

/**
 * MembersController Test Case
 *
 */
class MembersControllerTest extends ControllerTestCase {

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
 * testAdd method
 *
 * @expectedException NotFoundException
 * @return void
 */
	public function testAddNoMailList() {
		$this->testAction('/members/add', array(
			'return' => 'vars'
		));
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$mailListId = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$this->testAction('/members/add/' . $mailListId, array(
			'return' => 'vars',
			'method' => 'get'
		));
		$this->assertEquals($this->vars['mailList']['MailList']['id'], $mailListId);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAddPost() {
		$mailListId = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$Members = $this->generate('Members', array(
			'models' => array(
				'Member' => array('save')
			)
		));
		$Members->Member
			->expects($this->once())
			->method('save')
				->with(array(
					'Member' => array(
						'name' => 'Test',
						'email_address' => 'test2@example.com'
					),
					'MailList' => array('MailList' => array($mailListId))
				));

		$this->testAction('/members/add/' . $mailListId, array(
			'data' => array(
				'Member' => array(
					'name' => 'Test',
					'email_address' => 'test2@example.com'
				),
			),
			'return' => 'vars',
			'method' => 'post'
		));
	}

/**
 * testAdd method
 *
 * @expectedException NotFoundException
 * @return void
 */
	public function testAddManyNoMailList() {
		$this->testAction('/members/add_many', array(
			'return' => 'vars'
		));
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAddMany() {
		$mailListId = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$this->testAction('/members/add_many/' . $mailListId, array(
			'return' => 'vars',
			'method' => 'get'
		));
		$this->assertEquals($this->vars['mailList']['MailList']['id'], $mailListId);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAddManyPost() {
		$mailListId = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$members = "One test <onetest@example.com>\nTwo test <twotest@example.com>\nThree test (threetest@example.com)";
		$Members = $this->generate('Members', array(
			'models' => array(
				'Member' => array('createMembers')
			)
		));
		$Members->Member
			->expects($this->once())
			->method('createMembers')
				->with(array(
					'Member' => array(
						'members' => $members,
						'mail_list_id' => $mailListId
					)
				));

		$this->testAction('/members/add_many/' . $mailListId, array(
			'data' => array(
				'Member' => array(
					'members' => $members
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
