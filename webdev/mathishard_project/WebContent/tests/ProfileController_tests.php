<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User Controller</title>
</head>
<body>
<h1>User controller tests</h1>

<?php
//include all classes

include_once("../controllers/UserController.class.php");
include_once("../models/User.class.php");
include_once("../models/Messages.class.php");
include_once("../views/UserView.class.php");
?>

<h2>It should call the run method for valid input</h2>

<?php 
//required $post as input
$_SERVER ["REQUEST_METHOD"] == "POST";
$_POST = array();
UserController::run();
?>
</body>
</html>


