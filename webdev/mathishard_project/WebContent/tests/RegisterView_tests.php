<?php

echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Register View</title>
</head>
<body>
<h1>Register View tests</h1>';

include_once("../views/RegisterView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Register.class.php");

echo'<h2>It should show when $reguser has an input </h2>';

$_SESSION['base']='mk_project';
$_SESSION['control']='register';

$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
                "email" => "kris@utsa.edu", "pass" => "kris"
                , "pconf" => "kris", "bday" => "2015-7", "gender" => "Female", "lastName" => "kris"
                , "profpic" => "kris", "tele" => "1231231231", "status" => "Undergraduate"
                , "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
                , "linkPage" => "http://www.kristin.com");

$s1 = new Register($validTest);
$_SESSION['reguser']=serialize($s1);

RegisterView::show("form1");
unset($_SESSION['reguser']);


echo'<h2>It should show errors when $reguser has errors </h2>';

$_SESSION['base']='mk_project';
$_SESSION['control']='register';

$validTest = array("firstName" => "kris$", "lastName" => "kr", "userName" => "kri#s",
                "email" => "", "pass" => "kris"
                , "pconf" => "kris3", "bday" => "2015-7", "gender" => ""
                , "profpic" => "kris", "tele" => "12312", "status" => "Undergraduate"
                , "userRole" => "", "skill_level" => "", "errColor" => "#000000"
                , "linkPage" => "http://www.kristin.com");

$s1 = new Register($validTest);
$_SESSION['reguser']=serialize($s1);

RegisterView::show("form1");
unset($_SESSION['reguser']);






echo'</body>
</html>';
?>
