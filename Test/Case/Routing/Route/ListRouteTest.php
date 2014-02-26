<?php
App::uses('ListRoute', 'Routing/Route');

/**
 * ListRoute Test Case
 *
 */
class ListRouteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.domain',
		'app.mail_list'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		Cache::delete('domains');
		Cache::delete('mailLists');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
	}

	public function testDomainNameRouteMatch() {
		$url = Router::url(array(
			'controller' => 'domains',
			'action' => 'view',
			'52f8928d-6588-4f6f-ab87-430ef6570d8e'
		));
		$expected = '/example.com';
		$this->assertEqual($url, $expected);
	}

	public function testDomainNameRouteParse() {
		$route = Router::parse('/example.com');
		$expected = '52f8928d-6588-4f6f-ab87-430ef6570d8e';
		$this->assertEqual($route['pass'][0], $expected);
	}

	public function testMailListRouteMatch() {
		$url = Router::url(array(
			'controller' => 'mail_lists',
			'action' => 'view',
			'52f892d2-0d08-4c82-b685-4377f6570d8e' //Mail list id
		));
		$expected = '/test@example.com';
		$this->assertEqual($url, $expected);
	}

	public function testMailListRouteParse() {
		$route = Router::parse('/test@example.com');
		$expected = '52f892d2-0d08-4c82-b685-4377f6570d8e';
		$this->assertEqual($route['pass'][0], $expected);
	}

	public function testMailListAddRouteMatch() {
		$url = Router::url(array(
			'controller' => 'mail_lists',
			'action' => 'add',
			'52f8928d-6588-4f6f-ab87-430ef6570d8e' //Domain id
		));
		$expected = '/example.com/create';
		$this->assertEqual($url, $expected);
	}

	public function testMailListAddRouteParse() {
		$route = Router::parse('/example.com/create');
		$expected = '52f8928d-6588-4f6f-ab87-430ef6570d8e';
		$this->assertEqual($route['pass'][0], $expected);
	}

}
