<?php
require_once dirname(__FILE__). '\..\..\WebContent\models\Messages.class.php';

class MessagesTest extends PHPUnit_Framework_TestCase {


	public function testHasAMessage() {
		Messages::reset();
		$errorMessage = Messages::getError("FIRST_NAME_EMPTY");
		$this->assertTrue(!empty($errorMessage),
				'It should have an error messages for an invalid email');

	}

	public function testHasNoMessage() {
		Messages::reset();
		$errorMessage = Messages::getError("FAKE_ERROR");
		$this->assertTrue(empty($errorMessage),
				'It should not have an error messages for fake error');

	}



}
?>