<?php
App::uses('Member', 'Model');

/**
 * Member Test Case
 *
 */
class MemberTest extends CakeTestCase {

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
		$this->Member = ClassRegistry::init('Member');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Member);

		parent::tearDown();
	}

	public function testCreateMembers() {
		$Member = $this->getMockForModel('Member', ['saveMany']);
		$mailListId = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$members = "One test <onetest@example.com>\nTwo test <twotest@example.com>\nThree test (threetest@example.com)";

		$Member->expects($this->once())
			->method('saveMany')
				->with([
					['Member' => [
							'name' => 'One test',
							'email_address' => 'onetest@example.com',
						],
						'MailList' => ['MailList' => [$mailListId]]
					],
					['Member' => [
							'name' => 'Two test',
							'email_address' => 'twotest@example.com',
						],
						'MailList' => ['MailList' => [$mailListId]]
					],
					['Member' => [
							'name' => 'Three test',
							'email_address' => 'threetest@example.com',
						],
						'MailList' => ['MailList' => [$mailListId]]
					],
				]);

		$Member->createMembers([
			'Member' => [
				'members' => $members,
				'mail_list_id' => $mailListId
			]
		]);
	}

	public function testNonExistantList() {
		$member = [
			'Member' => [
				'name' => 'Test Guy3',
				'email_address' => 'testguy3@example.com'
			],
			'MailList' => ['MailList' => ['noList']]
		];
		$this->Member->set($member);
		$this->Member->validates();
		$this->assertTrue(!empty($this->Member->validationErrors['MailList']));
	}

	public function testExistingMember() {
		//Create a new mailing list
		$this->Member->MailList->save(['address' => 'test2', 'domain_id' => '52f8928d-6588-4f6f-ab87-430ef6570d8e']);
		$mailListId = $this->Member->MailList->id;

		$member = [
			'Member' => [
				'name' => 'Test Guy',
				'email_address' => 'testguy@example.com'
			],
			'MailList' => ['MailList' => [$mailListId]]
		];

		$this->Member->save($member);

		//Should still only be one member
		$count = $this->Member->find('count');
		$this->assertEqual($count, 2);

		//But this member should have 2 lists
		$member = $this->Member->find('first', [
			'conditions' => ['email_address' => 'testguy@example.com'],
			'contain' => ['MailList']
		]);
		$this->assertCount(2, $member['MailList']);
	}
}
