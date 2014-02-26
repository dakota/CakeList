<?php
App::uses('AppModel', 'Model');
/**
 * Member Model
 *
 * @property MailList $MailList
 */
class Member extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to enter the member\'s name',
			),
		),
		'email_address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You need to enter the member\'s email address',
			),
			'validEmail' => array(
				'rule' => array('email'),
				'message' => 'You need to give a valid email address'
			)
		),
		'MailList' => array(
			'exists' => array(
				'rule' => array('listExists')
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'MailList' => array(
			'unique' => false
		)
	);

	public function beforeValidate($options = array()) {
		foreach ($this->hasAndBelongsToMany as $key => $value) {
			if (isset($this->data[$key][$key])) {
				$this->data[$this->alias][$key] = $this->data[$key][$key];
			}
		}
	}

	public function save($data = null, $validate = true, $fieldList = array()) {
		if (isset($data[$this->alias]['email_address'])) {
			$existing = $this->findByEmailAddress($data[$this->alias]['email_address']);
			if ($existing) {
				$data[$this->alias][$this->primaryKey] = $existing[$this->alias][$this->primaryKey];
			}
		}

		return parent::save($data, $validate, $fieldList);
	}

	public function listExists($data) {
		if (empty($data['MailList'])) {
			return true;
		}

		foreach ($data['MailList'] as $listId) {
			if (!$this->MailList->exists($listId)) {
				return false;
			}
		}

		return true;
	}

	public function createMembers($data) {
		if (empty($data['Member']['members'])) {
			return false;
		}

		$members = explode("\n", $data['Member']['members']);
		$saveArray = [];
		$notSaved = [];
		foreach ($members as $member) {
			preg_match('/(.*) [<\(](.*)[>\)]/', trim($member), $matches);
			if (empty($matches[1]) || empty($matches[2])) {
				$notSaved[] = $member;
				continue;
			}

			$saveArray[] = [
				'Member' => [
					'name' => $matches[1],
					'email_address' => $matches[2]
				],
				'MailList' => [
					'MailList' => [
						$data['Member']['mail_list_id']
					]
				]
			];
		}

		return $this->saveMany($saveArray);
	}

}
