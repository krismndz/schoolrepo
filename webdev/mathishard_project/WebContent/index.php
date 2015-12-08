<?php
	ob_start();
	//session_unset($_SESSION);
	session_start();
	include("includer.php");   
	
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	list($fill, $base, $control, $action, $arguments) =  
	     explode('/', $url, 5) + array("", "", "", "", null);
	 $_SESSION['base'] = $base;
	 $_SESSION['control'] = $control; 
	 $_SESSION['action'] = $action;
	 $_SESSION['arguments'] = $arguments;
	
	switch ($control) {
		case "about":
			AboutView::show();
			break;
		case "login": 
			LoginController::run();
			break;
		case "logout":
			unset($_SESSION['users']);
			unset($_SESSION['user']);
			unset($_SESSION['userId']);
			unset($_SESSION['tempUserId']);
			unset($_SESSION['loginuser']);
			$_SESSION['control']="";
			HomeView::show();
			break;
		case "register":
			RegisterController::run();
			break;
		case "user";
			UserController::run();
			break;
		case "userlist";
			UserListController::run();
			break;
		case "edituser";
			EditUserController::run();
			break;
		case "tutorfinder";
			TutorFinderController::run();
			break;
		case "userhome";
			UserHomeView::show();
			break;
		case "user";
			UserController::run();
			break;
		case "tutoredit":
			TutorEditController::run();
			break;
		case "home":
			HomeView::show();
			break;
		default :
			HomeView::show();
			break;
	};
	ob_end_flush();
?>
