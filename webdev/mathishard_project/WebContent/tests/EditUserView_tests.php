<?php
echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Edit User View</title>
</head>
<body>';

echo'<h1>Edit User View tests</h1>';
include_once("../views/EditUserView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/EditUser.class.php");
include_once("../models/Messages.class.php");
include_once("./DBMaker.class.php");
include_once("../models/UsersDB.class.php");
include_once("../models/Database.class.php");
include_once("../models/User.class.php");
include_once("../views/UserView.class.php");

echo'<h2>It should show when $updateuser has a valid input </h2>';
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




$validTest = array('email'=> 'kris@kris2.com', 'tele'=>1111111111, 'status'=>'Undergraduate','userRole'=>'Tutor','skill_level'=>'Very confident');


$s1 = new EditUser($validTest,null);
$_SESSION['updateuser']=serialize($s1);

EditUserView::show(null);

unset($_SESSION['updateuser']);
unset($_SESSION['userId']);
unset($_SESSION['user']);
ob_end_flush();





echo'<h2>It should show errors when $updateuser has errors </h2>';
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




$validTest = array('email'=> 'kris@kris2.com', 'tele'=>1111111111, 'status'=>'','userRole'=>'Tutor','skill_level'=>'Very confident');


$s1 = new EditUser($validTest,null);
$_SESSION['updateuser']=serialize($s1);

EditUserView::show(null);

unset($_SESSION['updateuser']);
unset($_SESSION['userId']);
unset($_SESSION['user']);
ob_end_flush();

echo'<h2>It should show when $updateuser has a valid input for change password</h2>';


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

$validTest = array('pass'=> 'xxx','newpass'=>'xxy','newpconf'=>'xxy');

		

$s1 = new EditUser($validTest,"pass");
$_SESSION['updateuser']=serialize($s1);
EditUserView::show("pass");

unset($_SESSION['userId']);
unset($_SESSION['user']);
unset($_SESSION['updateuser']);

ob_end_flush();



echo'<h2>It should show errors when $updateuser has invalid input for change password</h2>';


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

$validTest = array('pass'=> 'xxx','newpass'=>'xxy','newpconf'=>'xy');



$s1 = new EditUser($validTest,"pass");
$_SESSION['updateuser']=serialize($s1);
EditUserView::show("pass");

unset($_SESSION['userId']);
unset($_SESSION['user']);
unset($_SESSION['updateuser']);

ob_end_flush();

echo'</body>
</html>';

?>
