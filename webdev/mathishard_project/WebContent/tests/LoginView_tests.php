<?php
echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login View</title>
</head>
<body>
<h1>Login view tests</h1>
';
include_once("../views/MasterView.class.php");
include_once("../views/LoginView.class.php");
include_once("../models/User.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Login.class.php");
//include_once("../css/login.css");
echo'<h2>It should call show when $user has an input</h2>';
$_SESSION['base']='mk_project';
$_SESSION['control']='login';


$validTest = array("userName" => "kris", "pass" => "kris");
$s1 = new Login($validTest);
$_SESSION['loginuser']=serialize($s1);

LoginView::show();
unset($_SESSION['loginuser']);

echo'<h2>It should show errors when $user has an invalid input</h2>';
$_SESSION['base']='mk_project';
$_SESSION['control']='login';


$validTest = array("userName" => "kris$", "pass" => " ");
$s1 = new Login($validTest);
$_SESSION['loginuser']=serialize($s1);

LoginView::show();
unset($_SESSION['loginuser']);




echo'</body>
</html>';

?>
