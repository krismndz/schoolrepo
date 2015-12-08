<?php
echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Tutor Edit View</title>
</head>
<body>';

echo'<h1>Tutor Edit View tests</h1>';
include_once("../views/TutorEditView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/EditUser.class.php");
include_once("../models/Course.class.php");
include_once("../models/Messages.class.php");
include_once("./DBMaker.class.php");
include_once("../models/CoursesDB.class.php");
include_once("../models/Database.class.php");
include_once("../models/User.class.php");
include_once("../views/UserView.class.php");
include_once("../models/UsersDB.class.php");
include_once("../models/TutorsListDB.class.php");
echo'<h2>It should show when $tutorcourse has a valid input </h2>';
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
$_SESSION['control']='tutoredit';
$course = new Course(array('courseName'=>'Pre-Calculus','courseProf'=>'','subject'=>'Math'));
$_SESSION['tutorCourse']=serialize($course);
$tutorId = TutorsListDB::getTutorIdFromUserId($user->getUserId());
		$courses = CoursesDB::getTutorCourses($tutorId);


TutorEditView::show($courses);

unset($_SESSION['tutorCourse']);
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
$_SESSION['control']='tutoredit';
$course = new Course(array('courseName'=>'','courseProf'=>'','subject'=>'Math'));
$_SESSION['tutorCourse']=serialize($course);
$tutorId = TutorsListDB::getTutorIdFromUserId($user->getUserId());
		$courses = CoursesDB::getTutorCourses($tutorId);


TutorEditView::show($courses);

unset($_SESSION['tutorCourse']);
unset($_SESSION['userId']);
unset($_SESSION['user']);
ob_end_flush();



echo'</body>
</html>';

?>
