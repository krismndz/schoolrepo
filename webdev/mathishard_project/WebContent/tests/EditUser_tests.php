<?php

echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Edit User</title>
</head>
<body>
<h1>Edit User tests</h1>
';
include_once("../models/UsersDB.class.php");
include_once("../models/Database.class.php");
include_once("./DBMaker.class.php");
include_once("../models/Register.class.php");
include_once("../models/EditUser.class.php");
include_once("../models/Messages.class.php");

echo'<h2>It should create a valid Edit User object when all input is provided</h2>';

DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$userarray= array("firstName" => "kris", "lastName" => "kris", "userName" => "bob",
                "email" => "bob@kris.com", "pass" => "kris"
                , "pconf" => "kris", "bdaymonth" => "July", "gender" => "female",
                 "profpic" => "", "tele" => "1231231231", "status" => "undergraduate", "userRole" => "Tutor", "skill_level" => "Very confident", "errColor" => "#00ffff"
                , "linkPage" => "linkedin.com/kris"
);
$user = new Register($userarray);


$user = UsersDB::addUser($user);
$_SESSION['userId'] = 1;


$validTest = array('email'=> 'kris@kris2.com', 'tele'=>1111111111, 'status'=>'Undergraduate','userRole'=>'Tutor','skill_level'=>'Very confident','errColor'=>'#00ffff','linkPage'=>'linkedin.com/kris');
$s1 = new EditUser($validTest);
echo $s1;
echo 'Error count: '.$s1->getErrorCount().'<br>';
unset($_SESSION['userId']);




echo'<h2>It should create errors when an  invalid Edit User object when all input is provided</h2>';
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$userarray= array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
		"email" => "kris@kris.com", "pass" => "kris"
		, "pconf" => "kris", "bdaymonth" => "July", "gender" => "female",
		 "profpic" => "", "tele" => "1231231231", "status" => "undergraduate", "userRole" => "Tutor", "skill_level" => "Very confident", "errColor" => "#00ffff"
		, "linkPage" => "linkedin.com/kris"
);
$user = new Register($userarray);


UsersDB::addUser($user);
print_r( $user->getUserId());
$_SESSION['userId']=1;
$validTest = array('pass'=> 'xxx','newpass'=>'xxy','newpconf'=>'xx','email'=> 'kris@kris2.com', 'tele'=>1111111111, 'status'=>'Undergraduate','userRole'=>'Tutor','skill_level'=>'Very_Confident','errColor'=>'#00ffff','linkPage'=>'linkedin.com/kris');
$s1 = new EditUser($validTest,"pass");
echo $s1;
echo 'Error count: '.$s1->getErrorCount().'<br>';
unset($_SESSION['userId']);


echo'
</body>
</html>';
?>
