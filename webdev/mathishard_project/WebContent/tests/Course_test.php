<?php


echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Courses</title>
</head>
<body>
<h1>User tests</h1>';
include_once("../models/Course.class.php");
include_once("../models/Messages.class.php");

echo "<h1>Tests Course class with valid input</h1><br>";

echo "<h2>It should create a valid course object</h2>";
$validtest = array('subject'=>'Math','coursename'=>'Calculus 1','professor'=>"");
$course = new Course($validtest);
echo $course;


echo "<h2>It should create errors with invalid course object</h2>";
$validtest = array('subject'=>'Math','coursename'=>'','professor'=>"");
$course = new Course($validtest);
echo $course;
echo "Error count: ".$course->getErrorCount();


echo'
</body>
</html>';
?>
