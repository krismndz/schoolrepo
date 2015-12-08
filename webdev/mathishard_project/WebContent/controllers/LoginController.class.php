<?php
class LoginController {

	public static function run() {

		$loginuser = null;
		$curuser=null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$loginuser = new Login($_POST); 
		
			$users = UsersDB::getUsersBy('userName', $loginuser->getUserName());
			if (empty($users))
			    $loginuser->setError('userName', 'USERNAME_DOES_NOT_EXIST');
			elseif (!$loginuser->verifyPassword($users[0]->getPasswordHash())) {
			    $loginuser->setError('pass', 'USER_PASSWORD_INCORRECT');
			} 
		}
		
		
		$_SESSION['loginuser'] = serialize($loginuser);
		
		if (is_null($loginuser) || $loginuser->getErrorCount() != 0) {
		   LoginView::show();	
		}
		else  {
			
			$usersarray = UsersDB::fetchUser('userName', $loginuser->getUserName());
			//print_r($usersarray);
			$userIdkey = $usersarray[0];
			$userId=$userIdkey['userId'];
			$_SESSION['userId']=$userId;
			$user = new User ($usersarray[0]);
		
			
			unset($_SESSION['loginuser']);
			$_SESSION['user'] = serialize($user);
		   HomeView::show();
	

			
		   header('Location: /'.$_SESSION['base']);
	
		
		}
	}
}
?>
 