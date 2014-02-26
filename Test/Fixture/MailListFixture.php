<?php
/**
 * MailListFixture
 *
 */
class MailListFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'domain_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'moderation_queue_count' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 11),
		'archived_message_count' => array('type' => 'integer', 'null' => false, 'default' => 0, 'length' => 11),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subject_prefix' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => 1),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'domain_id_2' => array('column' => array('domain_id', 'address'), 'unique' => 1),
			'domain_id' => array('column' => 'domain_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '52f892d2-0d08-4c82-b685-4377f6570d8e',
			'domain_id' => '52f8928d-6588-4f6f-ab87-430ef6570d8e',
			'moderation_queue_count' => 0,
			'archived_message_count' => 0,
			'address' => 'test',
			'name' => 'Test mailing list',
			'subject_prefix' => 'Test mail',
			'description' => 'Mailing list for tests',
			'active' => 1,
			'created' => '2014-02-10 10:50:26',
			'modified' => '2014-02-10 10:50:26'
		),
	);

}
