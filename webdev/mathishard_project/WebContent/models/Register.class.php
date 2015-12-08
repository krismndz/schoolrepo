<?php
//include ("Messages.class.php");
class Register {
	private $formInput;
	private $firstName;
	private $lastName;
	private $userName;
	private $email;
	private $pass;
	private $pconf;
	private $bdaymonth;
	private $bday;
	private $obday;
	private $passwordHash;
	private $day;
	private $bmonth;
	private $month;
	private $byear;
	private $gender;
	private $profpic;
	private $tele;
	private $status;
	private $userRole;
	private $skill_level;
	private $errColor;
	private $linkPage;
	public $errors;
	public $userId;
	//all parameters in register
	
	public function __construct($formInput = null, $type=null) {
		$this->formInput = $formInput;
		
		Messages::reset();
		if(is_null($type)){
			$this->initialize();
		}elseif($type=="form2"){
			$this->initializeFormTwo();
		}
		
	}
	//repeat getting for each of the variables
	//note pushed function get parameters()
	public function getUserPass(){
		return $this->pass;
	}
	public function __toString(){
		$ret = '<br>Username: '.$this->getUserName().'<br>Password: '.$this->getPassword().'<br>';
 $str = "<br>Email: ".$this->email."<br>Password: ".$this->pass
                ."<br>User Name: ".$this->userName."<br>First Name: ".$this->firstName."<br>Last name: ".$this->lastName."<br>Birth month: ".$this->bmonth."<br>Gender: ".$this->gender."<br>Phone number: ".$this->tele."<br>Status: ".
                $this->status."<br>User Role: ".$this->userRole."<br>Skill level:".$this->skill_level."<br>Error Color: ".
                $this->errColor."<br>Linked in Page: ".$this->linkPage."<br>";



		return $str;
	}	
	private function extractForm($valueName) {
		// Extract a stripped value from the form array
		$value = "";
		if (!is_null($this->formInput) &&
			isset($this->formInput[$valueName])) {
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
		else{
			$this->validateFormOne();
			
		}
		
	}
	private function validateFormOne(){
		$this->validateFirstName();
		$this->validateLastName();
		$this-> validateUserName();
		$this->validateUserEmail();
		$this->validateConfirmPass();
		$this->validatePassword();
		
	}
	public function validateFormTwo(){

	
		$this->validateBday();
		$this->validateGender();
		$this->validatePic();
		$this->validatePhoneNum();
		$this->validateStatus();
		$this->validateUserRole();
		$this-> validateSkill();

	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->firstName="";
		$this->lastName="";
		$this-> userName="";
		$this->email="";
		$this->pass="";
		$this-> pconf="";
		$this->bdaymonth="";
		$this->byear="";
		$this->bmonth="";
		$this->bday="";
		$this->day="";
		$this->obday="";
		$this->gender="";
		$this->profpic="";
		$this->tele="";
		$this->day="";
		$this->status="";
		$this->userRole="";
		$this-> skill_level="";
		$this->errColor="#00ffff";
		$this->linkPage="";
		$this->passwordHash="";
	}
	
	public function initializeFormTwo(){
	$this -> errorCount = 0;
		$errors= array();
		if (is_null($this->formInput)){
			$this->initializeEmpty();
		}
		else{
			$this->validateFormTwo();
			
		}
	}
	
	//note pushed validate first name function 
	private function validateFirstName() {
		$this->firstName = $this->extractForm('firstName');
		if (empty($this->firstName))
			$this->setError('firstName', 'FIRST_NAME_EMPTY');
		elseif (!filter_var($this->firstName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('firstName', 'FIRST_NAME_HAS_INVALID_CHARS');
		}

		
	}	
	private function validateLastName(){
		$this->lastName = $this->extractForm('lastName');
		if (empty($this->firstName))
			$this->setError('lastName', 'LAST_NAME_EMPTY');
		elseif (!filter_var($this->lastName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('lastName', 'LAST_NAME_HAS_INVALID_CHARS');
		}
		elseif(strlen(trim($this->lastName))<=2){
			$this->setError('lastName', 'LAST_NAME_TOO_SHORT');
		}
	}
	private function validateUserName(){
		$this->userName = $this->extractForm('userName');
		if (empty($this->userName))
			$this->setError('userName', 'USER_NAME_EMPTY');
		elseif (!filter_var($this->userName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('userName', 'USER_NAME_HAS_INVALID_CHARS');
		}
	}
	
	private function  validateUserEmail(){
		$this->email = $this->extractForm('email');
		
		if(empty($this->email)){
			$this->setError('email','EMAIL_EMPTY');
		}
	elseif (!filter_var($this->email, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_@.])+$/i")) )) {
			$this->setError('email', 'EMAIL_INVALID_CHARS');
		}
	}
	private function validateConfirmPass(){
		$this->pconf = $this->extractForm('pconf');
		if (empty($this->pconf))
			$this->setError('pconf', 'PASSWORD_CONFIRM_EMPTY');
		
	}
	private function validatePassword(){

		if(!empty( $this->extractForm('pass'))){
			$this->pass = $this->extractForm('pass');
			$this->passwordHash=password_hash($this->pass,PASSWORD_DEFAULT);
		
		}
		if (empty($this->pass)){
			$this->setError('pass', 'PASSWORD_EMPTY');
		}
		elseif(!(empty($this->pass)) && !(empty($this->pconf))){
			if(!($this->pass== $this->pconf)){
				$this->setError('pass', 'PASSWORD_NOT_MATCH');
			}
		}
		
		

		
	}
	
	private function validateBday(){

		//$this->bmonth=$this->extractForm('month');
		$this->bday=$this->extractForm('bday');
		$this->obday=$this->extractForm('bday');
		//print_r($this->obday);
	//	$this->byear=$this->extractForm('year');

		if(empty($this->bday)){
			$this->setError('bday', 'BDAY_EMPTY');
		
		}else{

		//$this->bdaymonth = $this->extractForm('bday');
		/**if(empty($this->bdaymonth)){
			$this->setError('bday', 'BDAY_EMPTY');
		}**/
		
		list($this->byear,$this ->bmonth,$this->day) =explode('-', $this->obday,3);
		$this->bday =$this->bmonth.'/'.$this->day.'/'.$this->byear;
		}
	/**	switch($this->bmonth){
			case "1":
				$this->bday = "January";
				break;
			case "2":
				$this->bday = "February";
				break;
			case "3":
				$this->bday = "March";
				break;
			case "4":
				$this->bday = "April";
				break;
			case "5":
				$this->bday = "May";
				break;
			case "6":
				$this->bday = "June";
				break;
			case "7":
				$this->bday = "July";
				break;
			case "8":
				$this->bday = "August";
				break;
			case "9":
				$this->bday = "September";
				break;
			case "10":
				$this->bday = "October";
				break;
			case "11":
				$this->bday = "November";
				break;
			case "12":
				$this->bday = "December";
				break;
			default:
				break;
			
		}**/
		
	}
	
	public function getUid(){
		
	}
	private function validateGender(){
		$this->gender = $this->extractForm('gender');
		if(empty($this->gender)){
			$this->setError('gender', 'GENDER_EMPTY');
		}
	}
	private function validatePic(){
		$this->profpic = $this->extractForm('profpic');
	}
	private function validatePhoneNum(){
		$this->tele = $this->extractForm('tele');
		
		if(empty($this->tele)){
			$this->setError('tele','PNUM_EMPTY');
		}
		elseif (strlen(trim($this->tele))< 10){
			$this->setError('tele', 'PNUM_TOO_SHORT');
		}
		
	}
	
	private function validateStatus(){
		$this->status = $this->extractForm('status');
		
		if(empty($this->status)){
			$this->setError('status','STATUS_EMPTY');
		}
	}
	
	private function validateUserRole(){
		$this->userRole = $this->extractForm('userRole');
		if(empty($this->userRole)){
			$this->setError('userRole','USER_ROLE_EMPTY');
		}
		
	}
	
	private function validateSkill(){
		$this->skill_level = $this->extractForm('skill_level');
		if(empty($this->skill_level)){
			$this->setError('skill_level','SKILL_EMPTY');
		}
	}
	/**private function validateErrColor(){
		$this->errColor = $this->extractForm('errColor');
		if(empty($this->errColor)){
			$this->setError('errColor','COLOR_EMPTY');
		}
		elseif($this->errColor=="#000000"){
			$this->setError('errColor','COLOR_DEFAULT');
		}
	
	}**/
	private function validateLinkPage(){
		$this->linkPage = $this->extractForm('linkPage');
		if(empty($this->linkPage)){
			$this->linkPage = "http://www.linkedin.com";
		}
	
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
	
	
	public function getErrorCount() {
		return $this->errorCount;
	}
	
	public function getErrors() {
		return $this->errors;
	}
	public function getFirstName(){
		return $this->firstName;
	}
	
	public function setFirstName($name){
		$this->firstName=$name;
	}
	public function getFullName(){
		return $this->firstName." ".$this->lastName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	public function setLastName($name){
		$this->lastName=$name;
	}
	public function setEmail($name){
		$this->email=$name;
	}
	public function getUserName(){
		return $this->userName;
		
	}
	public function setUserName($name){
		$this->userName=$name;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setPassword($name){
		$this->pass=$name;
	}
	
	public function setPasswordConf($name){
		$this->pconf=$name;
	}
	public function getPassword(){
		return $this->pass;
	}
	
	public function getPasswordConf(){
		return $this->pconf;
	}
	
	public function getBday(){
		return $this->bday;
	}
	public function getBday2(){
		return $this->obday;
	}
	public function getBdayMonth(){
		return $this->bday;
	}
	

	public function getGender(){
		return $this->gender;
	}
	
	public function getPnum(){
		return $this->tele;
	}
	
	public function getStatus(){
		return $this->status;
	}
	public function getUserRole(){
		return $this->userRole;
	}
	public function getSkillLevel(){
	//	echo $this->skill_level;
		return $this->skill_level;
	}
	public function getErrColor(){
		return $this->errColor;
	}
	public function getLinkPage(){
		return $this->linkPage;
	}
	public function setUserId($id){
		$this->userId = $id;
	}
	public function getUserId(){
		return $this->userId;
	}

	public function getPasswordHash(){
		return $this->passwordHash;
	}
	public function setPasswordHash($hash){
		$this->passwordHash=$hash;
	}
}
?>
