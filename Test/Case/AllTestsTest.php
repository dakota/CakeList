<?php
/**
 * @package OctoCake\Tests
 */
class AllTestsTest extends CakeTestSuite {

	public static function suite() {
		$path = APP . 'Test' . DS . 'Case' . DS;

		$suite = new CakeTestSuite('All tests');
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}
}