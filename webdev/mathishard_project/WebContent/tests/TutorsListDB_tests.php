<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for TutorsListDB</title>
</head>
<body>
<h1>TutorsListDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../models/UsersDB.class.php");
include_once("../models/TutorsListDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should get a tutorID from a user ID</h2>
<?php
ob_start();
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$_SESSION['userId']=1;
$user = UsersDB::getUsersBy('userId',1);
$user =  $user[0];
$_SESSION['user']=serialize($user);
$_SESSION['base']='mk_project';

$tutorId = TutorsListDB::getTutorIdFromUserId($user->getUserId());
echo "UserId: ".$user->getUserId()."<br>Pulled tutor id: ".$tutorId."<br>";

ob_end_flush();
?>
<h2>It should get add a new tutor from a user  object</h2>
<?php
ob_start();
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$validTest= array("firstName" => "kris", "lastName" => "kris", "userName" => "test",
                "email" => "kris@kris.com", "pass" => "kris"
                , "pconf" => "kris", "bday" => "July", "gender" => "female",
                 "profpic" => "", "tele" => "1231231231", "status" => "undergraduate", "userRole" => "Tutor", "skill_level" => "Very confident", "errColor" => "#00ffff"
                , "linkPage" => "linkedin.com/kris"
);



$s1 = new User($validTest);
echo "User: <br>".$s1;



$_SESSION['user']=serialize($user);
$_SESSION['base']='mk_project';
$tutorid= TutorsListDB::addTutor($user);
echo "<br>New tutor id: ".$tutorid."<br>";

ob_end_flush();
?>


</body>
</html>
