<?php

echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Edit User Controller</title>
</head>
<body>
<h1>Edit User controller tests</h1>
';
//include all classes
include_once("../controllers/EditUserController.class.php");
include_once("../models/EditUser.class.php");
include_once("../models/Messages.class.php");
include_once("../views/MasterView.class.php");
include_once("../views/EditUserView.class.php");
include_once("./DBMaker.class.php");
include_once("../models/UsersDB.class.php");
include_once("../models/Database.class.php");
include_once("../models/User.class.php");
include_once("../views/UserView.class.php");
echo'<h2>It should call the run for a get method and auto-fill current user info</h2>';

ob_start();
//required $post as input
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$_SESSION['userId']=1;
$user = UsersDB::getUsersBy('userId',1);
$user =  $user[0];
$_SESSION['user']=serialize($user);
$_SESSION['base']='mk_project';
$_SESSION['control']='edituser';
$_SERVER ["REQUEST_METHOD"] == "GET";
EditUserController::run();
unset($_SESSION['userId']);
unset($_SESSION['user']);
ob_end_flush();
echo'<h2>It should call the run method for a post method, change user info and direct to user profile page</h2>';

//required $post as input
ob_start();
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$_SESSION['userId']=1;
$user = UsersDB::getUsersBy('userId',1);
$user =  $user[0];
$_SESSION['user']=serialize($user);
$_SESSION['base']='mk_project';
$_SESSION['control']='edituser';
$_SERVER["REQUEST_METHOD"]="POST";
$_POST = array('pass'=> 'xxx','newpass'=>'xxy','newpconf'=>'xxy','email'=> 'kris@kris2.com', 'tele'=>1111111111, 'status'=>'Undergraduate','userRole'=>'Tutor','skill_level'=>
'Very_confident','errColor'=>'#00ffff','linkPage'=>'linkedin.com/kris');

EditUserController::run();
unset($_SESSION['userId']);
unset($_SESSION['user']);
ob_end_flush();
echo'</body>
</html>';

?>
