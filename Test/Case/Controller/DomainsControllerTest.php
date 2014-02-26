<?php
App::uses('DomainsController', 'Controller');

/**
 * DomainsController Test Case
 *
 */
class DomainsControllerTest extends ControllerTestCase {

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
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction('/domains/index', array(
			'return' => 'vars'
		));
		$this->assertCount(1, $this->vars['domains']);
	}

/**
 * testView method
 *
 * @expectedException NotFoundException
 * @return void
 */
	public function testViewWithoutDomain() {
		$this->testAction('/domains/view', array(
			'return' => 'vars'
		));
	}

/**
 * testView method
 * 
 * @return void
 */
	public function testView() {
		$domainId = '52f8928d-6588-4f6f-ab87-430ef6570d8e';
		$this->testAction('/domains/view/' . $domainId, array(
			'return' => 'vars'
		));
		$this->assertEquals($this->vars['domain']['Domain']['id'], $domainId);
		$this->assertCount(1, $this->vars['domain']['MailList']);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
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
