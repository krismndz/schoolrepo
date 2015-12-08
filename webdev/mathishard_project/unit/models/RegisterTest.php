<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Register.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
class RegisterTest extends PHPUnit_Framework_TestCase {

	
	public function testValidRegister(){
		$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
		"email" => "kris@utsa.edu", "pass" => "kris"
		, "pconf" => "kris", "bdaymonth" => "2015-7", "gender" => "Female", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "1231231231", "role" => "Undergraduate"
		, "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
		, "linkPage" => "http://www.kristin.com");
		$r1 = new Register($validTest);
		$this->assertTrue(is_a($r1,'Register'),
				'It should create a valid register object when all input is provided ');
	}
	
	public function testInvalidRegister(){
		$invalidTest = array("firstName" => "kris$", "lastName" => "kr", "userName" => "kri#s",
		"email" => "", "pass" => "kris"
		, "pconf" => "kris3", "bdaymonth" => "2015-7", "gender" => ""
		, "profpic" => "kris", "tele" => "12312", "role" => "Undergraduate"
		, "userRole" => "", "skill_level" => "", "errColor" => "#000000"
		, "linkPage" => "http://www.kristin.com");
		
		$r1 = new Register($invalidTest);
		$this->assertTrue($r1->getErrorCount() > 0,
				'It should have an error if the registration info is invalid ');
	}

}
?>