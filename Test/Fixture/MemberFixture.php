<?php
/**
 * MemberFixture
 *
 */
class MemberFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '52f893df-e0b4-49a8-ad66-43e4f6570d8e',
			'name' => 'Test Guy',
			'email_address' => 'testguy@example.com',
			'created' => '2014-02-10 10:54:55',
			'modified' => '2014-02-10 10:54:55'
		),
		array(
			'id' => '52f894df-e0b6-49a8-ad66-43e4f6570d8e',
			'name' => 'Test Guy 2',
			'email_address' => 'testguy2@example.com',
			'created' => '2014-02-10 10:54:55',
			'modified' => '2014-02-10 10:54:55'
		),
	);

}
