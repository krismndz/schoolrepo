<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login Controller</title>
</head>
<body>
<br><br><br><h1>Login controller tests</h1>

<?php
//include all classes

include_once("../controllers/LoginController.class.php");
include_once("../models/User.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/LoginView.class.php");
include_once("../models/Messages.class.php");
include_once("./DBMaker.class.php");
?>

<h2>It should call the run method for valid input</h2>

<?php 
$_SESSION['base']='mk_project';
//required $post as input
$_SERVER ["REQUEST_METHOD"] == "POST";
$_POST = array("userName"=>"kris", "pass"=>"passtemp");
LoginController::run();
?>
</body>
</html>


