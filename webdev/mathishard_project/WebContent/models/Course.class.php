<?php

class Course {
	private $formInput;

	private $errors;
	private $errorCount;

	private $courseName;
	private $subject;
	private $professor;
	
	public function __construct($formInput=null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
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
	
	
	


	
	public function __toString() {
		$str = "Subject: ".$this->subject."<br>Course Name: ".$this->courseName.'<br>';
		return $str;
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
		
		if (is_null($this->formInput)){
			$this->initializeEmpty();
		}
		else  	{
		   	$this->validateSubject();
		   	$this->validateCourseName();
		   	$this->validateProfessor();
		}
		
	}
	
	public function initializeEdit($forminput) {
		//echo $forminput;
		//$this->editforminput= (!is_null($forminput))?$forminput:null;
		
		$this -> errorCount = 0;
		$errors= array();
		if (is_null($forminput))
			$this->initializeEmpty();
		else{
			print_r("<br>Course Class<br>". $forminput);
			$this->validateCourseName();
			$this->validateSubject();
			$this->validateProfessor();
		}
	
	}
	private function initializeEmpty(){
		$this->subject = "";
		$this->courseName="";
		$this->professor = "";
	}
	private function  validateCourseName(){
		
		$this->courseName = $this->extractForm('courseName');
	
		if(empty($this->courseName)){
			$this->setError('courseName','COURSE_NAME_EMPTY');
		}
		
	}
	
	
	private function  validateSubject(){
		$this->subject = $this->extractForm('subject');
	
		if(empty($this->subject)){
			$this->setError('subject','SUBJECT_EMPTY');
		}
		
	}
	
	private function validateProfessor(){
		$this->professor = $this->extractForm('courseProf');
		if(empty($this->professor)){
			$this->professor = "na";
		}
	
	}

	public function setSubject(){
		$this->subject = $this->extractForm('subject');
	}
	public function setCourseName(){
		$this->courseName = $this->extractForm('courseName');
	}
	public function setProfessor(){
		$this->professor = $this->extractForm('courseProf');
	}
	public function getSubject(){
		
		return $this->subject;
	}
	public function getCourseName(){
		
		return $this->courseName;
	}
	public function getErrorCount() {
		return $this->errorCount;
	}
	public function getErrors() {
		return $this->errors;
	}
	public function getProfessor(){
		return $this->professor;
	}
	
}
?>
