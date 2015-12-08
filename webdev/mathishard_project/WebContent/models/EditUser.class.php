<?php

class EditUser {
	private $formInput;
	private $currHash;
	private $errors;
	private $errorCount;
	private $newPasswordHash;
	private $userName;
	private $pass;
	private $newpass;
	private $newpconf;
	private $firstName;
	private $lastName;
	private $email;
	private $byear;
	private $bmonth;
	private $gender;
	private $profpic;
	private $tele;
	private $status;
	private $userRole;
	private $skill_level;
	private $errColor;
	private $linkPage;
	private $bday;
	private $realpass;
	private $editforminput;
	private $userId;
	public function __construct($formInput, $type=null) {
		$this->formInput = $formInput;
		$this->userId = $_SESSION['userId'];
		Messages::reset();
		if(is_null($type)){
			$this->initializeEdit();
		}
		elseif($type=="pass"){
			$this->initializeChangePass();
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
	
	
	


	
	public function __toString() {
		$str = "<br>Email: ".$this->email."<br>Password: ".$this->pass
		."<br>New Password: ".$this->newpass."<br>New Password Confirm: ".$this->newpconf."<br>Phone number: ".$this->tele."<br>Status: ".
		$this->status."<br>User Role: ".$this->userRole."<br>Skill level:".$this->skill_level."<br>Error Color: ".
		$this->errColor."<br>Linked in page: ".$this->linkPage."<br>";


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
	
	
	public function initializeEdit() {
	
		//$this->editforminput= (!is_null($forminput))?$forminput:null;
		
		$this -> errorCount = 0;
		$errors= array();
		if (is_null($this->formInput))
			$this->initializeEditEmpty();
		else{

		/**
			$this->validatePassword();
			$this->validateNewPassword();
			$this->validateNewConfirmPass();
		**/	
	
			$this->validateUserEmail();
			$this->validatePic();
			$this->validatePhoneNum();
			$this->validateStatus();
			
			$this-> validateSkill();
		

			//if they want to change the password, its initiated by 
			//entering values in either one of the three 
			if($this->extractForm('pass') == "" && $this->extractForm('newpass') =="" && $this->extractForm('newpconf')=="" ){
				//dont validate this information	

			}else{
			
			}
		}
	
	}
	
	
	public function getNewPasswordHash(){
		$ret=$this->newPasswordHash;
		return $ret;
	}
	public function initializeChangePass(){
		$this->errorCount = 0;
		$errors = array();
		
		
		if (is_null($this->formInput)){
			$this->pconf="";
			$this->pass="";
			$this->newpass="";
		}else{
			$this->validatePassword();
			$this->validateNewPassword();
			$this-> validateNewConfirmPass();
		}
	}
	public function validateChangePass($forminput){
		$this->formInput = $formInput;
		$this->validatePassword();
		$this->validateNewPassword();
		$this-> validateNewConfirmPass();
	}
	private function initializeEditEmpty(){
	
		
		$this->errorCount = 0;
		$errors = array();

		//$this-> userName="";
		$this->email="";

		$this->profpic="";
		$this->tele="";
		$this->status="";
		$this->userRole="";
		$this-> skill_level="";
		$this->errColor="";
		$this->linkPage="";
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
		//$this->realpass=UsersDB::getPassword($this->userId);
		$this->pass = $this->extractForm('pass');
		if (strlen(trim($this->pass))==0)
			$this->setError('pass', 'PASSWORD_UPDATE_EMPTY');
	/**	elseif($this->pass != $this->realpass)
			$this->setError('pass','PASSWORD_UPDATE_NON_MATCH');**/
	}
	private function validateNewConfirmPass(){
		$this->newpconf = $this->extractForm('newpconf');
		if (empty($this->newpconf))
			$this->setError('newpconf', 'NEW_PASSWORD_CONFIRM_EMPTY');
		elseif(!empty($this->newpconf)&& !empty($this->newpass)){
			if(($this->newpconf!= $this->newpass)){
				$this->setError('newpass','NEW_PASSWORD_NOT_MATCH');
			}	
		}	
	}
	private function validateNewPassword(){
		$this->newpass = $this->extractForm('newpass');

		if (empty($this->newpass))
			$this->setError('newpass', 'NEW_PASSWORD_EMPTY');
	
		elseif(!(empty($this->newpass)) && !(empty($this->newpconf))){
			if(!($this->newpass== $this->newpconf)){
				$this->setError('newpass', 'NEW_PASSWORD_NOT_MATCH');
			}
		}
	}
	public function setNewPasswordHash(){
		$this->newPasswordHash=password_hash($this->newpass,PASSWORD_DEFAULT);
	}
	public function verifyPassword($hash){
		if (strlen(trim($this->pass))==0){
			$this->setError('pass', 'PASSWORD_UPDATE_EMPTY');
			return -1;
		}
		else{
			return password_verify($this->pass, $hash);
		}
		
	}
	public function verifyNewPassword($hash){
		return password_verify($this->newpass, $hash);
	}
	private function setFirstName() {
		$this->firstName = $this->extractForm('firstName');

	
	
	}
	private function setLastName(){
		$this->lastName = $this->extractForm('lastName');

	}
	private function setUserName(){
		$this->userName = $this->extractForm('userName');
		//echo $this->userName;

	}
	
	private function  setUserEmail(){
		$this->email = $this->extractForm('email');
	
	
	}
	
	private function setPassword(){
		$this->pass = $this->extractForm('pass');
	
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
	private function setUserId(){
		$this->uid = $this->extractForm('userId');
	}
	public function getRealPassword(){
		return UsersDb::getPassword($this->userId);
	}
	public function getPassword(){
		return $this->pass;
	}
	public function getNewPassword(){
		return $this->newpass;
	}
	public function getNewPasswordConf(){
		return $this->newpconf;
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
	public function getFullName(){
		return $this->firstName." ".$this->lastName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	
	public function getUserName(){
		return $this->userName;
	}
	
	public function getEmail(){
		return $this->email;
	}
	

	
	public function getBday(){
		
		
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
		return $this->skill_level;
	}
	public function getErrColor(){
		return $this->errColor;
	}
	public function getLinkPage(){
		return $this->linkPage;
	}
	
	public function getUserId(){
		return $this->userId;
	}
	
}
?>
