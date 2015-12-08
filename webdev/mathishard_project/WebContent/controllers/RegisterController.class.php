<?php
class RegisterController {
	// all controllers have a run method
	public static function run() {

		
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$reqmethod= $_SERVER["REQUEST_METHOD"];
		
		/**switch($reqmethod){
			case "POST":
				switch($action){
					case "form1":
						self::checkFormOne();
						break;
					case "form2":
						self::checkFormTwo();
						break;
					default:
						break;
				}
				break;
			
			default:
				switch($action){
					case "form1":
						unset($_SESSION['reguser']);
						unset($_SESSION['reguser1']);
						unset($_SESSION['reguser2']);
						self::checkFormOne();
						break;
					case "form2":
						self::checkFormTwo();
						break;
					default:
						unset($_SESSION['reguser']);
						unset($_SESSION['reguser1']);
						unset($_SESSION['reguser2']);
						RegisterView::show('form1');
						break;
				}
				
				break;
		}**/
		switch($action){
			case "form1":
				self::checkFormOne();
				break;
			case "form2":
				self::checkFormTwo();
				break;
			default:
				break;
		}
		

			
		
	}
	
	public static function checkFormOne(){
		$reguser=null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$reguser= new Register($_POST);
			//check if username or email already exists in DB
			$usernames = UsersDB::getUsersBy('userName', $reguser->getUserName());
			$useremails= UsersDB::getUsersBy('email', $reguser->getEmail());
			//print_r($users);
			if(!empty($useremails)){
				$reguser->setError('email', 'EMAIL_ALREADY_EXISTS');
			}
			if(!empty($usernames)){
				$reguser->setError('userName', 'USERNAME_ALREADY_EXISTS');
			}
			if(empty($usernames) && empty($useremails)){
				//create a user with information
		
		
				if (is_null($reguser) || $reguser->getErrorCount() != 0) {
					
				}
				else{
			
				}
		
			}
		}
		else{
			unset($_SESSION['reguser']);
			unset($_SESSION['reguser2']);
		}
		$_SESSION['reguser']= serialize($reguser);
		
		//show with errors
		//set reguser in session
		if (is_null($reguser) || $reguser->getErrorCount() !=0 ) {
			RegisterView::show('form1');
		}
		else{
		
			/**$reguser = UsersDB::addUser($reguser);
			$newid = $reguser->getUserId();
			$_SESSION['userId']=$newid;
			$usersarray = UsersDB::fetchUser('userId', $newid);
			//print_r($usersarray);
			$user = new User($usersarray[0]);
			unset($_SESSION['reguser']);
			$_SESSION['user']= serialize($user);
		
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'home');**/
		/**	if($user->getUserRole()=="Tutor"){
				//TutorsListDB::addTutor($user);
			
				
				//TutorEditView::show(null);
				//header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'tutoredit');
			}**//**else{
				HomeView::show();
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'home');
			
			}**/
			$reguser->initializeFormTwo();
			RegisterView::show('form2');
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.$_SESSION['control'].'/form2');
			
	
		
		}
		
	}
	public static function checkFormTwo(){
		if(is_null(unserialize($_SESSION["reguser"]))){
			self::checkFormOne();
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.$_SESSION['control'].'/form1');
		}else{
		$reguser2 = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$reguser2 =new Register($_POST,"form2");
		
			//$reguser= unserialize($_SESSION['reguser']);
			$_SESSION['reguser2']= serialize($reguser2);
			
			/**echo'<br><br><br><br>';
			foreach($_POST as $key => $val){
				
					print_r($key."->".$val."<br>");
				
					
			}**/
				
		}
		$_SESSION['reguser2']= serialize($reguser2);
		
		if (is_null($reguser2) || $reguser2->getErrorCount() !=0 ) {
			RegisterView::show('form2');
			
			
		}else{
			$reguser1=unserialize($_SESSION['reguser']);
			RegisterView::show('form2');
			
			
			$reguser2->setFirstName($reguser1->getFirstName());
			$reguser2->setLastName($reguser1->getLastName());
			$reguser2->setUserName($reguser1->getUserName());
			$reguser2->setEmail($reguser1->getEmail());
			$reguser2->setPassword($reguser1->getPassword());
			$reguser2->setPasswordHash($reguser1->getPasswordHash());	
				//preform add on new user$reguser = UsersDB::addUser($reguser);
				$reguser2 = UsersDB::addUser($reguser2);
				$newid = $reguser2->getUserId();
				$_SESSION['userId']=$newid;
				$usersarray = UsersDB::fetchUser('userId', $newid);
				//print_r($usersarray);
				$user = new User($usersarray[0]);
				unset($_SESSION['reguser']);
				unset($_SESSION['reguser2']);
				$_SESSION['user']= serialize($user);
			
				//header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'home');
				if($user->getUserRole()=="Tutor"){
					TutorsListDB::addTutor($user);
						
			
					TutorEditView::show(null);
					header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'tutoredit');
				}else{
					HomeView::show();
					header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'home');
						
				}
			
			
			}
		}
	}
}
?>
 
