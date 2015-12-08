<?php
class TutorRequest{
	private $studentId;
	private $tutorId;
	private $courseId;
	private $courseName;
	public $studentMessage;
	private $forminput;
	private $requestId;
	private $studentPhone;
	private $tutorPhone;
	public $tutorViewed;
	public $responded;
	public $responseViewed;
	public $timesSuggestT;
	public $timeSelectS;
	public $location;
	public $phoneBool;
	public $emailBool;
	public $contact;
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
	}
	
	
	
	
	public function getStudentId() {
		return $this->studentId;
	}
	public function getTutorId() {
		return $this->tutorId;
	}
	public function getCourseName() {
		return $this->courseName;
	}
	public function getStudentMessage() {
		$ret= $this->studentMessage;
		return $ret;
	}
	public function __toString() {
		$str = "<br>Student Id: ".$this->studentId."<br>Student message: ".$this->studentMessage."<br>"
				."<br>Course: ".$this->courseName."<br>";
		return $str;
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
			$this->validateCourseName();
			$this->validateStudentId();
			$this->validateTutorId();
			$this->validateStudentMessage();
			$this->validateStudentPhone();
			$this->validateContact();
		}
	
	}
	
	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->courseName = "";
		$this->studentId = "";
		$this->tutorId="";
		$this->studentMessage="";
		$this->requestId="";
		$this->studentPhone="";
		$this->phoneBool="";
		$this->emailBool="";
		$this->contact="";
		$this->tutorViewed="0";
		$this->responded="0";
		$this-> responseViewed="";
		$this-> timesSuggestT="";
		$this->timeSelectS="";
		$this->location="";
	}
	private function validateContact(){
		$this->contact=$this->extractForm('contact');
		if($this->contact==""){
			$this->setError('contact', 'CONTACT_EMPTY');
			
		}
		if($this->contact=="Both"){
			$this->phoneBool="1";
			$this->emailBool="1";
		}elseif($this->contact=="Phone"){
			$this->phoneBool="1";
			$this->emailBool="0";
		}elseif($this->contact=="E-mail"){
			$this->phoneBool="0";
			$this->emailBool="1";
		}
	}
	private function validateStudentPhone(){
		$this->studentPhone= $this->extractForm('studentPhone');
	}
	private function validateTutorPhone(){
		$this->tutorPhone= $this->extractForm('tutorPhone');
	}
	private function validateTutorViewed(){
		$this->tutorViewed= $this->extractForm('tutorViewed');
	}
	private function validateResponded(){
		$this->responded= $this->extractForm('responded');
		
	}
	private function validateResponseViewed(){
		$this->responseViewed= $this->extractForm('responseViewed');
	}
	private function validateTimeSuggestT(){
		$this->timeSuggestT= $this->extractForm('timeSuggestT');
	}
	private function validateTimeSelectS(){
		$this->timeSelectS= $this->extractForm('timeSelectS');
		
	}
	private function validateLocation(){
		$this->location= $this->extractForm('location');
	}
	private function validateCourseName() {
		$this->courseName = $this->extractForm('courseChosen');
		if (empty($this->courseName))
			$this->setError('courseChosen', 'COURSE_CHOSEN_EMPTY');
	
	}
	private function validateStudentId(){
		$this->studentId= $this->extractForm('studentId');
	}
	private function validateTutorId(){
		$this->tutorId= $this->extractForm('tutorId');
	}
	private function validateStudentMessage(){
		$this->studentMessage=$this->extractForm('studentMessage');
		if(empty($this->studentMessage)){
			$this->setError('studentMessage',MESSAGE_EMPTY);
		}
	}
	
	public function getStudentPhone(){
		$ret = $this->studentPhone;
		return $ret;
	}
	public function getTutorPhone(){
		$ret=$this->tutorPhone;
		return $ret;
	}
	public function getErrorCount() {
		return $this->errorCount;
	}
	
	public function getErrors() {
		return $this->errors;
	}
	public function getPhoneBool(){
		return $this->phoneBool;
		
	}
	public function getEmailBool(){
		return $this->emailBool;
	}
}
?>