<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for UsersDB</title>
</head>
<body>
<h1>UsersDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");

include_once("../models/User.class.php");

include_once("../models/UsersDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should create get all users from a test database</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');


$users = UsersDB::getUsersBy();
$userCount = count($users);		

echo "Number of users in db is: $userCount <br>";
foreach ($users as $user) 
	
	echo "$user <br>";
?>	

<h2>It should allow a user to be added</h2>
<?php 


DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
echo "Number of users in db before added is: ". count(UsersDB::getUsersBy()) ."<br>";
$validTest = array('userName'=>'kay', 'pass'=>'xxx', 'firstName'=>'kristin',
				'lastName'=>'mendoza', 'email'=>'kay@me.com','bday'=>'July', 'gender'=>'female', 'tele'=>1231231231,
				'status'=>'Graduate','userRole'=>'Tutor', 'skill_level'=>'Very confident',
				'errColor'=>'#ff0000','linkPage'=> 'http://www.linkedin.com');
$user = new User($validTest);
$userId = UsersDB::addUser($user);
echo "Number of users in db after added is: ". count(UsersDB::getUsersBy2()) ."<br>";
echo "The new user is: $userId<br>";
?>

<h2>It should not add an invalid user</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
echo "Number of users in db before added is: ". count(UsersDB::getUsersBy()) ."<br>";
$invalidUser = new User(array("userName" => "krobbins$"));
$userId = UsersDB::addUser($invalidUser);
echo "Number of users in db after added is: ".count(UsersDB::getUsersBy()) ."<br>";
echo "User ID of new user is: $userId<br>";
?>

<h2>It should get a User by userName</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$user = UsersDB::getUsersBy('userName', 'jubilee');
echo "The value of User jubilee is:<br>$user[0]<br>";
?>

<h2>It should get a User by userId</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$user = UsersDB::getUsersBy('userId', '3');

echo "The value of User 3 is:<br>".$user[0]."<br>";
?>

<h2>It should not get a User not in Users</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$user = UsersDB::getUsersBy('userName', 'Alfred');

echo "The value of User Alfred is:<br>".$user[0]."<br>";
?>

<h2>It should not get a User by a field that isn't there</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$user = UsersDB::getUsersBy('telephone', '21052348234');
echo "The value of User with a specified telephone number is:<br>$user<br>";
?>

<h2>It should get a user name by user id</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$userNames = UsersDB::getUserValuesBy('userName', 'userId', 1);
echo "Username for id 1: ".$userNames[0];
?>

</body>
</html>