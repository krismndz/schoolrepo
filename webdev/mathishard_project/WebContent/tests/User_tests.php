<?php

echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User</title>
</head>
<body>
<h1>User tests</h1>
';
include_once("../models/User.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Register.class.php");
echo'<h2>It should create a valid User object when all input is provided</h2>';
$validTest = array("userName" => "kris", "pass" => "kris");
$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
                "email" => "kris@kris.com", "pass" => "kris"
                , "pconf" => "kris", "bday" => "July", "gender" => "female",
                 "profpic" => "", "tele" => "1231231231", "status" => "Undergraduate", "userRole" => "Tutor",
                "skill_level" => "Very confident", "errColor" => "#00ffff"
                , "linkPage" => "","passwordHash"=>password_hash("passtemp",PASSWORD_DEFAULT)
);



$s1 = new User($validTest);
echo 'User object: '.$s1.'<br>';

echo'<h2>It should create errors when an invalid user is provided</h2>';
$validTest = array("userName" => "kris$", "pass" => " ");
$s1 = new Register($validTest);
echo 'User object: '.$s1.'<br>';
echo 'Number of errors: '.$s1->getErrorCount().'<br>';




echo'</body>
</html>';
?>
