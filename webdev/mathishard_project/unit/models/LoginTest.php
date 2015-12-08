<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Login.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
class LoginTest extends PHPUnit_Framework_TestCase {

	
	public function testValidLoginCreate(){
		$validTest = array("userName" => "kris", "pass" => "kris");
		$s1 = new Login($validTest);
		$this->assertTrue(is_a($s1,'Login'),
				'It should create a valid user object when all input is provided ');
	}
	
	public function testInvalidUserName(){
		$invalidTest = array("userName" => "kris$", "pass" => "kris");
		$s1 = new Login($invalidTest);
		$this->assertTrue($s1->getErrorCount() > 0,
				'It should have an error if the user name is invalid ');
	}

}
?>