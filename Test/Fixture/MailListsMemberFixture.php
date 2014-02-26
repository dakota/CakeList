<?php
/**
 * MailListsMemberFixture
 *
 */
class MailListsMemberFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mail_list_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'member_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mail_list_id' => array('column' => array('mail_list_id', 'member_id'), 'unique' => 1)
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
			'id' => '52f89551-80cc-44d3-8ca6-4587f6570d8e',
			'mail_list_id' => '52f892d2-0d08-4c82-b685-4377f6570d8e',
			'member_id' => '52f893df-e0b4-49a8-ad66-43e4f6570d8e',
			'created' => '2014-02-10 11:01:05',
			'modified' => '2014-02-10 11:01:05'
		),
		array(
			'id' => '52f89551-84cc-44d3-8ca6-4587f6570d8e',
			'mail_list_id' => '52f892d2-0d08-4c82-b685-4377f6570d8e',
			'member_id' => '52f894df-e0b6-49a8-ad66-43e4f6570d8e',
			'created' => '2014-02-10 11:01:05',
			'modified' => '2014-02-10 11:01:05'
		),		
	);

}
