<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Register Controller</title>
</head>
<body>
<h1>Register controller tests</h1>

<?php
//include all classes
include_once("../controllers/RegisterController.class.php");
include_once("../models/Register.class.php");
include_once("../models/Messages.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/RegisterView.class.php");
include_once("./DBMaker.class.php");
?>

<h2>It should call the run method for valid input</h2>

<?php 
//required $post as input
$myDb = DBMaker::create('ptest');
$_SESSION['base']='mk_project';
$_SERVER ["REQUEST_METHOD"] == "POST";
$_POST = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
		"email" => "kris@kris.com", "pass" => "kris"
		, "pconf" => "kris", "bdaymonth" => "July", "gender" => "kris", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "1231231231", "role" => "kris", "userRole" => "kris"
		, "userRole" => "kris", "skill_level" => "kris", "errColor" => "kris"
		, "linkPage" => "kris"
);
RegisterController::run();
?>
</body>
</html>


