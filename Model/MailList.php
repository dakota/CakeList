<?php
App::uses('AppModel', 'Model');
/**
 * MailList Model
 *
 * @property Domain $Domain
 * @property Member $Member
 */
class MailList extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'domain_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				'message' => 'Please select a valid domain name',
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to enter an email address for this mailing list',
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to enter a name for this mailing list',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Domain'
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Member'
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = [
		'ModerationQueue',
		'ArchivedMessage',
		'MailQueue'
	];

/**
 * Fetches a mailing list based on the address
 * @param  string $mailingList Full mailing list address to test
 * @return mixed              array if valid, false if invalid
 */
	public function getList($mailingList) {
		list($address, $domain) = explode('@', $mailingList);
		$list = $this->find('first', array(
			'contain' => array(
				'Domain.domain',
				'Member.email_address'
			),
			'conditions' => array(
				'MailList.address' => $address,
				'Domain.domain' => $domain
			)
		));

		return $list ?: false;
	}

	public function validMember($mailingList, $fromAddress) {
		return true;
	}

}
