<?php
/**
*/
//Call Parbake's AllTestCase
require_once ROOT . DS . APP_DIR . DS . 'Test' . DS . 'Case' . DS . 'AllTestCase.php';

/**
 */
class AllUsersPluginTest extends AllTestCase {
	/**
	 * Assemble Test Suite
	 *
	 * @return PHPUnit_Framework_TestSuite the instance of PHPUnit_Framework_TestSuite
	 */
	public static function suite() {
		$suite = new self;
		$files = $suite->getTestFiles('Users');
		$suite->addTestFiles($files);

		return $suite;
	}
}
