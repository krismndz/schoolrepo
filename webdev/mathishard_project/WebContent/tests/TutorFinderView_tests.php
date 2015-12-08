<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for tutor finder page </title>
</head>
<body>
<h1>Tutor finder page tests</h1>

<?php
include_once("../views/TutorFinderView.class.php");
include_once("../models/TutorFinder.class.php");
include_once("../models/CoursesDB.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/UsersDB.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Database.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/TutorsListDB.class.php");
?>


<h2>It should show the tutor finder page for valid input </h2>
<?php 
ob_start();
//required $post as input
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$courses = CoursesDB::getAllCourses();
$_SESSION['courses']=serialize($courses);
$subjects = array();

foreach($courses as $course){
	if(empty($sujects)){
		array_push($subjects,$course['subject']);
	}elseif(!var_dump(in_array($course['subject'],$subjects))){
		array_push($subjects,$course['subject']);
		print_r($subjects);
	}
}
$_SESSION['subjects']=serialize($subjects);
$_SESSION['headertitle'] = "Tutor Finder";
$validTest = array("courseName" => "Calculus3", "subject" => "Math");
$s1 = new TutorFinder($validTest);
$_SESSION['tutorFinder']=serialize($s1);
TutorFinderView::showAll();
ob_end_flush();
?>
<h2>It should show the tutor finder page with errors on invalid input </h2>
<?php

ob_start();
//required $post as input
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$courses = CoursesDB::getAllCourses();
$_SESSION['courses']=serialize($courses);
$subjects = array();

foreach($courses as $course){
	if(empty($sujects)){
		array_push($subjects,$course['subject']);
	}elseif(!var_dump(in_array($course['subject'],$subjects))){
		array_push($subjects,$course['subject']);
		print_r($subjects);
	}
}
$_SESSION['subjects']=serialize($subjects);
$_SESSION['headertitle'] = "Tutor Finder";
$validTest = array("courseName" => "", "subject" => "");
$s1 = new TutorFinder($validTest);
$_SESSION['tutorFinder']=serialize($s1);
TutorFinderView::showAll();
ob_end_flush();
?>

<h2>It should show the found tutors for Calculus 3 </h2>
<?php
ob_start();
//required $post as input
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');

$courses = CoursesDB::getAllCourses();
$_SESSION['courses']=serialize($courses);
$subjects = array();

foreach($courses as $course){
	if(empty($sujects)){
		array_push($subjects,$course['subject']);
	}elseif(!var_dump(in_array($course['subject'],$subjects))){
		array_push($subjects,$course['subject']);
		print_r($subjects);
	}
}
$_SESSION['subjects']=serialize($subjects);
$_SESSION['headertitle'] = "Tutor Finder";
$validTest = array("courseName" => "Calculus3", "subject" => "Math");
$s1 = new TutorFinder($validTest);
$_SESSION['tutorFinder']=serialize($s1);

$course=$finder->getCourseName();
$allusers = UsersDB::getUsersBy2();
$tutorUsers = array();
foreach($allusers as $user){
	if($user['userRole']=="Tutor"){
		$tutorId = TutorsListDB::getTutorIdFromUserId($user['userId']);
		$courseArray= CoursesDB::getTutorCourses($tutorId);
		foreach($courseArray as $name){
			if($name['courseName']==$course){
				array_push($tutorUsers,$user);
					
			}
		}
			
		//	array_push($tutorUsers,$user);
	}
}
	
$_SESSION['foundTutors']=serialize($tutorUsers);
TutorFinderView::showFoundTutor();
ob_end_flush();
?>
</body>
</html>