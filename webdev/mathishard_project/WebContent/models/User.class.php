<?php

class User {
	private $formInput;

	private $errors;
	private $errorCount;

	public $userName;
	private $pass;
	private $newpass;
	private $newpconf;
	public $firstName;
	public $lastName;
	public $email;
	private $byear;
	private $bmonth;
	public $gender;
	private $profpic;
	private $tele;
	public $status;
	public $userRole;
	private $skill_level;
	private $errColor;
	private $linkPage;
	public $bday;
	private $userId;
	private $realpass;
	private $editforminput;
	private $passwordHash;
	public function __construct($formInput) {
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
		$str = "User name: ".$this->userName."<br>Password: ".$this->pass;
		 $str = "<br>Email: ".$this->email."<br>Password: ".$this->pass
                ."<br>User Name: ".$this->userName."<br>First Name: ".$this->firstName."<br>Last name: ".$this->lastName."<br>Birth month: ".$this->bday."<br>Gender: ".$this->gender."<br>Phone number: ".$this->tele."<br>Status: ".                $this->status."<br>User Role: ".$this->userRole."<br>Skill level:".$this->skill_level."<br>Error Color: ".
                $this->errColor."<br>Linked in Page: ".$this->linkPage."<br>Password Hash: ".$this->passwordHash."<br>";


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
			
		}

			else  	{
		   	$this->setFirstName();
			$this->setLastName();
			$this-> setUserName();
			$this->setUserEmail();
	
			$this->setPassword();
			$this->setBday();
			$this->setGender();
			//$this->setPic();
			$this->setPhoneNum();
			$this->setStatus();
			$this->setUserRole();
			$this-> setSkill();
			$this->setErrColor();
			$this->setLinkPage();
			$this->setUserId();
			$this->setPasswordHash();
		}
		
	}
	private function setPasswordHash(){
		$this->passwordHash=$this->extractForm('passwordHash');
	}
	public function initializeEdit($forminput) {
		//echo $forminput;
		//$this->editforminput= (!is_null($forminput))?$forminput:null;
		
		$this -> errorCount = 0;
		$errors= array();
		if (is_null($forminput))
			$this->initializeEditEmpty();
		else{

		
			$this->validatePassword();
			$this->validateNewConfirmPass();
			$this->validateNewPassword();
	
			$this->validateUserEmail();
			$this->validatePic();
			$this->validatePhoneNum();
			$this->validateStatus();
			$this->validateUserRole();
			$this-> validateSkill();
			$this->validateErrColor();
			$this->validateLinkPage();
		}
	
	}
	private function initializeEditEmpty(){
		$this->pconf="";
		$this->pass="";
		$this->newpass="";
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
	private function validatePic(){
		$this->profpic = $this->extractForm('profpic');
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
	private function validateErrColor(){
		$this->errColor = $this->extractForm('errColor');
		if(empty($this->errColor)){
			$this->setError('errColor','COLOR_EMPTY');
		}
		elseif($this->errColor=="#000000"){
			$this->setError('errColor','COLOR_DEFAULT');
		}
	
	}
	private function validateLinkPage(){
		$this->linkPage = $this->extractForm('linkPage');
		if(empty($this->linkPage)){
			$this->linkPage = "http://www.linkedin.com";
		}
	
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
	
	private function validatePassword(){
		$this->realpass=UsersDB::getRealPassword($this->userId);
		$this->pass = $this->extractForm('pass');
		if (empty($this->pass))
			$this->setError('pass', 'PASSWORD_UPDATE_EMPTY');
		elseif($this->pass != $this->realpass)
			$this->setError('pass','PASSWORD_UPDATE_NON_MATCH');
	}
	private function validateNewConfirmPass(){
		$this->newpconf = $this->extractForm('newpconf');
		if (empty($this->newpconf))
			$this->setError('newpconf', 'NEW_PASSWORD_CONFIRM_EMPTY');
		
	}
	private function validateNewPassword(){
		$this->newpass = $this->extractForm('newpass');

		if (empty($this->newpass))
			$this->setError('pass', 'NEW_PASSWORD_EMPTY');
	
		if(!(empty($this->newpass)) && !(empty($this->newpconf))){
			if(!($this->newpass== $this->newpconf)){
				$this->setError('pass', 'NEW_PASSWORD_NOT_MATCH');
			}
		}
	}
	
	private function setFirstName() {
		$this->firstName = $this->extractForm('firstName');

	
	
	}
	private function setLastName(){
		$this->lastName = $this->extractForm('lastName');

	}
	private function setUserName(){
		$this->userName = $this->extractForm('userName');
	//	echo $this->userName;

	}
	
	private function  setUserEmail(){
		$this->email = $this->extractForm('email');
	
	
	}
	
	private function setPassword(){
		$this->pass="";
		//$this->pass = $this->extractForm('pass');
	
	}
	private function setBday(){
		$this->bday = $this->extractForm('bday');
	
		
	
		
	}
	private function setGender(){
		$this->gender = $this->extractForm('gender');
	
	}
	private function setPic(){
		$this->profpic = $this->extractForm('profpic');
	}
	private function setPhoneNum(){
		$this->tele = $this->extractForm('tele');
	
	
	
	}
	
	private function setStatus(){
		$this->status = $this->extractForm('status');
	

	}
	
	private function setUserRole(){
		$this->userRole = $this->extractForm('userRole');
	
	
	}
	
	private function setSkill(){
		$this->skill_level = $this->extractForm('skill_level');
	
	}
	private function setErrColor(){
		$this->errColor = $this->extractForm('errColor');
	
	
	}
	private function setLinkPage(){
		$this->linkPage = $this->extractForm('linkPage');
	
	}
	public function setUserId(){
		$this->userId = $this->extractForm('userId');
	}
	public function getRealPassword(){
		return UsersDB::getPassword($this->userId);
	}
	public function getPassword(){
		return $this->pass;
	}
	public function getNewPassword(){
		return $this->newpass;
	}
	public function getNewConfPassword(){
		return $this->newpconf;
	}
	public function getErrorCount() {
		return $this->errorCount;
	}
	
	public function getErrors() {
		return $this->errors;
	}
	public function getFirstName(){
		/**if(!is_null($id)){
			//$_SESSION['tempId']=$id;
			$ret = UsersDB::fetchUserType('firstName');
		}else{
			$ret = UsersDB::fetchUserType('firstName');
		}**/
		
		//return $ret;
		return $this->firstName;
	}
	public function getFullName(){
		
		return User::getFirstName()." ".User::getLastName();
	}
	public function getLastName(){
		return $this->lastName;
		//$ret = UsersDB::fetchUserType('lastName');
		//return $ret;
	}
	
	public function getUserName(){
		/**if(!is_null($id)){
		
			$ret = UsersDB::fetchUserType('userName',$id);
		}else{
			$ret = UsersDB::fetchUserType('userName');
		}
	
		return $ret;**/
	
		return $this->userName;
	}
	
	public function getEmail(){
		//$ret = UsersDB::fetchUserType('email');
		//return $ret;
		return $this->email;
	}
	

	
	public function getBday(){
		//$ret = UsersDB::fetchUserType('bday');
		//return $ret;
		
		return $this->bday;
	}
	

	public function getGender(){
		//$ret = UsersDB::fetchUserType('gender');
		//return $ret;
		return $this->gender;
	}
	
	public function getPnum(){
		//$ret = UsersDB::fetchUserType('tele');
		//return $ret;
		return $this->tele;
	}
	
	public function getStatus(){
		//$ret = UsersDB::fetchUserType('status');
		//return $ret;
		return $this->status;
	}
	public function getUserRole(){
		//$ret = UsersDB::fetchUserType('userRole');
		//return $ret;
		return $this->userRole;
	}
	public function getSkillLevel(){
		//$ret = UsersDB::fetchUserType('skill_level');
		//return $ret;
		return $this->skill_level;
	}
	public function getErrColor(){
		//$ret = UsersDB::fetchUserType('errColor');
		//return $ret;
		return $this->errColor;
	}
	public function getLinkPage(){
		//$ret = UsersDB::fetchUserType('linkPage');
		//return $ret;
		return $this->linkPage;
	}
	
	public function getUserId(){
		return $this->userId;
	}
	public function setUpdateEmail($email){
		$this->email = $email;
	}
	
	public function setUpdatePnum($pnum){
		$this->tele = $pnum;
	}
	public function setUpdateStatus($stat){
		$this->status = $stat;
	}
	
	public function setUpdateSkillLevel($skill){
		$this->skill_level = $skill;
	}
	
	public function setUpdateLinkPage($link){
		$this->linkPage = $link;
	}
	
	public function setUpdateErrColor($err){
		$this->errColor = $err;
	}
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("userName" => $this->userName,
				"password" => $this->password,
				"userId" => $this->userId
		);
		return $paramArray;
	}
	public function getPasswordHash(){
		return $this->passwordHash;
	}

	
}
?>
