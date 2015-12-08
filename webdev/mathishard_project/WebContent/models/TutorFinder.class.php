<?php
class TutorFinder {
	private $formInput;
	private $errors;
	private $tutorclass;
	private $subject;

	
	private $courseName;

	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
	}

	public function pullTutors(){
		
	}
	public function getCourseName() {
		return $this->courseName;
	}
	
	public function getSubject(){
		return $this->subject;
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
		   $this->validateCourse();
		   $this->validateSubject();
		}
	}
	
	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->courseName="";
	 	$this->subject="";
	}

	private function validateCourse() {
		$this->courseName = $this->extractForm('courseName');
		if (empty($this->courseName)|| ($this->courseName=="Select One")) {
			$this->setError('courseName', 'COURSE_CHOICE_EMPTY');
			//print_r("set error for course name");
		}
	}	
	private function validateSubject(){
		$this->subject=$this->extractForm('subject');
		if (empty($this->subject)){
			$this->setError('subject', 'SUBJECT_CHOICE_EMPTY');
		
		}
		
	}
	
	public function getErrorCount() {
		return $this->errorCount;
	}

	public function getErrors() {
		return $this->errors;
	}
	

	
}
?>