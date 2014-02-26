<?php
App::uses('AppModel', 'Model');
/**
 * ArchivedMessage Model
 *
 * @property MailList $MailList
 */
class ArchivedMessage extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mail_list_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
			),
		),
		'message' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = [
		'MailList' => [
			'counterCache' => true
		]
	];
}
