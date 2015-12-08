<?php
//include ("Messages.class.php");
class Login {
	private $formInput;
	private $userName;
	private $pass;
	private $errors;
	private $errorCount;
	private $currUser;
	


	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
	}

	public function getUserName() {
		return $this->userName;
	}
	public function __toString() {
		$str = "<br>User name: ".$this->userName."<br>Password: ".$this->pass."<br>";
		return $str;
	}
	
	public function getUserPass(){
		return $this->pass;
	}
	
	public function setError($errorName, $errorValue) {
		
		// Sets a particular error value and increments error count
		$this->errors[$errorName] =  Messages::getError($errorValue);
		$this->errorCount ++;
	}
	
	public function getError($errorName) {
		if (isset($this->errors[$errorName]))
			return $this->errors[$errorName];
		else
			return "";
	}
	

	
	private function extractForm($valueName) {
		// Extract a stripped value from the form array
		$value = "";
		if (isset($this->formInput[$valueName])) {
			$value = trim($this->formInput[$valueName]);
			$value = stripslashes ($value);
			$value = htmlspecialchars ($value);
			return $value;
		}
	}
	private function initialize() {
		$this -> errorCount = 0;
		$errors= array();
		
		if (is_null($this->formInput))
			$this->initializeEmpty();
		else  	{
		   $this->validateUserName();
		   $this->validatePassword();
		}
		
	}
	
	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->userName = "";
	 	$this->pass = "";
	 	$this->currUser = null;
	}

	private function validateUserName() {
		$this->userName = $this->extractForm('userName');
		if (empty($this->userName)) 
			$this->setError('userName', 'USER_NAME_EMPTY');
		elseif (!filter_var($this->userName, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('userName', 'USER_NAME_HAS_INVALID_CHARS');
		}
		
	}	
	
	public function getErrorCount() {
		return $this->errorCount;
	}

	public function getErrors() {
		return $this->errors;
	}
	
	private function validatePassword(){
		$this->pass = $this->extractForm('pass');
		if (strlen(trim($this->pass))<=0)
			$this->setError('pass', 'PASSWORD_EMPTY');
		
	}
	
	public function verifyPassword($hash){
		return password_verify($this->pass, $hash);
	}

}
?>
