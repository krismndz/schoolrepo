<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User View</title>
</head>
<body>
<h1>User View tests</h1>

<?php
include_once("../views/UserView.class.php");
include_once("../models/User.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Database.class.php");
include_once("../models/TutorsListDB.class.php");
include_once("../models/CoursesDB.class.php");
include_once("../views/MasterView.class.php");
?>


<h2>It should show profile for a student</h2>
<?php 

$_SESSION['base']='mk_project';
$_SESSION['control']='user';
$validTest = array("firstName" => "kris", "lastName" => "mendoza", "userName" => "kris",
		"email" => "kris@utsa.edu", "pass" => "kris"
		, "pconf" => "kris", "bday" =>"07/12/1993", "gender" => "Female", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "1231231231", "status" => "Undergraduate"
		, "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
		, "linkPage" => "http://www.kristin.com");


$s1 = new User($validTest);
$_SESSION['user']=serialize($s1);
UserView::show();
unset($_SESSION['user']);
?>

<h2>It should show profile for a tutor</h2>
<?php 

$_SESSION['base']='mk_project';
$_SESSION['control']='user';
$validTest = array("firstName" => "kris", "lastName" => "mendoza", "userName" => "kris",
		"email" => "kris@utsa.edu", "pass" => "kris"
		, "pconf" => "kris", "bday" => "07/12/1993",  "gender" => "Female", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "1231231231", "status" => "Undergraduate"
		, "userRole" => "Tutor", "skill_level" => "Very Confident", "errColor" => "#ff0000"
		, "linkPage" => "http://www.kristin.com");


$s1 = new User($validTest);
$_SESSION['user']=serialize($s1);
UserView::show();
unset($_SESSION['user']);
?>



</body>
</html>
