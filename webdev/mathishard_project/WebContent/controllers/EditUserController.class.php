<?php
class EditUserController {
	// all controllers have a run method
	public static function run() {
	
	
		//User::initializeEdit(null);
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$arguments =  (array_key_exists('arguments', $_SESSION))?$_SESSION['arguments']:"";
		$reqmethod= $_SERVER["REQUEST_METHOD"];
		switch ($action) {
			case "password":
				self::editPass();
				break;
			case "all":
				self::editAll();
				break;
			default:
				self::editAll();
				break;
		}		
	}
	public static function editPass(){
		//EditUserView::show("pass");
		$updateuser = null;
		$user = unserialize($_SESSION['user']);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
				$updateuser= new EditUser($_POST,"pass");
				$_SESSION['updateuser']= serialize($updateuser);
				
				if (!$updateuser->verifyPassword($user->getPasswordHash())) {
					$updateuser->setError('pass', 'PASSWORD_UPDATE_NON_MATCH');
				}else{
					$updateuser->setNewPasswordHash();
				}
			
		}
		$_SESSION['updateuser']= serialize($updateuser);
		
			//show with errors
			//set reguser in session
		if (is_null($updateuser) || $updateuser->getErrorCount() != 0) {
			EditUserView::show("pass");
		}
		else{
					
			$user = unserialize($_SESSION['user']);
		
			$updateuser = unserialize($_SESSION['updateuser']);
			$userid=$_SESSION['userId'];

			
		/**	if($updateuser->getNewPassword()!=$user->getPassword()){
				//echo"hi";
				UsersDB::updateUser('pass',$updateuser->getNewPassword(),$userid);
		
			}**/
				UsersDB::updateUser('passwordHash',$updateuser->getNewPasswordHash(),$userid);
			
				$_SESSION['user']= serialize($user);
				UserView::show();
				unset($_SESSION['updateuser']);
				//header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'user');
			}
	}

	public static function editAll(){
		$updateuser = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$updateuser = new EditUser($_POST,null);
			/**
			 if(empty($useremails)){
			 //$updateuser = unserialize($_SESSION['user']);
			 $updateuser = new EditUser($_POST);
			 }
			 **/	}
			$_SESSION['updateuser']= serialize($updateuser);
		
			//show with errors
			//set reguser in session
			if (is_null($updateuser) || $updateuser->getErrorCount() != 0) {
				EditUserView::show(null);
			}
			else{
					
				$user = unserialize($_SESSION['user']);
		
				$updateuser = unserialize($_SESSION['updateuser']);
				$userid=$_SESSION['userId'];
					
					
				if($updateuser->getEmail()!=$user->getEmail()){
		
					$useremails= UsersDB::getUsersBy2('email', $updateuser->getEmail());
						
					//print_r( $useremails[0]);
					if(!empty($useremails)){
						$usertemp = $useremails[0];
		
						$useridtemp = $usertemp['userId'];
						$userid= $updateuser ->getUserId();
						if(!($useridtemp == $userid)){
							$updateuser->setError('email', 'EMAIL_ALREADY_EXISTS');
						}
					}
					$user->setUpdateEmail($updateuser->getEmail());
					UsersDB::updateUser('email',$updateuser->getEmail(),$userid);
						
				}
			
				if($updateuser->getPnum()!=$user->getPnum()){
					//echo"hi";
					$user ->setUpdatePnum($updateuser->getPnum());
					UsersDB::updateUser('tele',$updateuser->getPnum(),$userid);
						
				}
				if($updateuser->getStatus()!=$user->getStatus()){
					//echo"hi";
					$user->setUpdateStatus($updateuser->getStatus());
					UsersDB::updateUser('status',$updateuser->getStatus(),$userid);
						
				}
				if($updateuser->getSkillLevel()!=$user->getSkillLevel()){
					//echo"hi";
		
					$user->setUpdateSkillLevel($updateuser->getSkillLevel());
		
					UsersDB::updateUser('skill_level',$updateuser->getSkillLevel(),$userid);
						
				}
				
				$_SESSION['user']= serialize($user);
				UserView::show();
				unset($_SESSION['updateuser']);
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'user');
			}	
	}
	
	
}
?>
