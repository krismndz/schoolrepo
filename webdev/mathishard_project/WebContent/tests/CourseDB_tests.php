<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for CoursesDB</title>
</head>
<body>
<h1>CoursesDB tests</h1>


<?php
include_once("../models/Database.class.php");
include_once("../models/Messages.class.php");

include_once("../models/Course.class.php");

include_once("../models/CoursesDB.class.php");
include_once("./DBMaker.class.php");
?>


<h2>It should get all the courses from a test database</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');


$courses = CoursesDB::getAllCourses();
$courseCount = count($courses);		

echo "Number of courses in db is: $courseCount <br>";
foreach ($courses as $course) 
	
	print_r($course['courseName'].'<br>');
?>	

<h2>It should allow a course to be added</h2>
<?php 


DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');

echo "Number of courses in db before added is: ". count(CoursesDB::getAllCourses()) ."<br>";
$validTest = array('courseName'=>'Elementary Algebra', 'subject' => 'Math', 'courseProf' => 'na');
$course = new Course($validTest);
$courseId = CoursesDB::addCourse($course);
echo "Number of courses in db after added is: ". count(CoursesDB::getAllCourses()) ."<br>";
echo "The new courseId is: $courseId<br>";
?>

<h2>It should not add an invalid course</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
echo "Number of courses in db before added is: ". count(CoursesDB::getAllCourses()) ."<br>";
$invalidCourse = new Course(array('courseName' => '','subject'=>'','courseProf'=>''));

try{
$courseId = CoursesDB::addCourse($invalidCourse);

echo "Course ID of new course is: $courseId<br>";
}catch(PDOException $e){
	echo("PDOException caught: ".$e->getMessage()."<br>");
}
echo "Number of courses in db after added is: ".count(CoursesDB::getAllCourses()) ."<br>";
?>

<h2>It should get a Course by course name</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$course = CoursesDB::getCoursesBy('courseName', 'Calculus 3');
//print_r($course);
$course = $course[0];
echo "The value of course Calculus 3  is:<br>$course <br>";
?>

<h2>It should get a Course by courseId</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
$course = CoursesDB::getCoursesBy('courseId', '1');

echo "The value of course with id 1 is:<br>".$course[0]."<br>";
?>

<h2>It should not get a Course not in Courses</h2>
<?php 
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
try{

$course = CoursesDB::getCoursesBy('courseName', 'Fake Math');
echo "The value of course 'Fake Math' is:<br>".$course[0]."<br>";
}catch(PDOException $e){
	echo "PDOException caught: " .$e->getMessage()."<br>";
}
?>

<h2>It should not get a course by a field that isn't there</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
try{
$course = CoursesDB::getCoursesBy('telephone', '458390453');
echo "The value of course with a specified telephone number is:<br>$course<br>";
 }catch(PDOException $e){
	echo "PDOException caught: ".$e->getMessage()."<br>";

}
?>

<h2>It should get a course name by course id</h2>
<?php
DBMaker::create('ptest');
Database::clearDB();
$db = Database::getDB('ptest');
try{
$courseNames = CoursesDB::getCoursesArray(CoursesDB::getCourseRowSetsBy( 'courseId', 1));
echo "Course name for id 1: ".$courseNames[0]->getCourseName();
}catch(PDOException $e){
	echo "PDO Exception caught: ". $e->getMessage()."<br>";
}

?>

</body>
</html>
