<?php
/**
*/
//Call Parbake's AllTestCase
require_once ROOT . DS . APP_DIR . DS . 'Test' . DS . 'Case' . DS . 'AllTestCase.php';

/**
 */
class AllUsersPluginTest extends AllTestCase {
	
	/**
	 * Constructor
	 * Passes the plugin to be tested to the parent.
	 */
	public function __construct() {
		parent::__construct('Users');
	}

	/**
	 * Assemble Test Suite
	 *
	 * @return PHPUnit_Framework_TestSuite the instance of PHPUnit_Framework_TestSuite
	 */
	public static function suite() {
		$suite = new self;
		$files = $suite->getTestFiles();
		$suite->addTestFiles($files);

		return $suite;
	}
}
