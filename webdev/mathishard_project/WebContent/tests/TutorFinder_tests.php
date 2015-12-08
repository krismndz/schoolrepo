<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User</title>
</head>
<body>
<h1>Tutor Finder tests</h1>

<?php
include_once("../models/TutorFinder.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Messages.class.php");
?>

<h2>It should create a valid tutor finder object when all input is provided</h2>
<?php 
$validTest = array("courseName" => "Calculus3", "subject" => "Math");
$s1 = new TutorFinder($validTest);
echo 'Number of errors: '.$s1->getErrorCount().'<br>';
?>

<h2>It should create errors when an invalid input is provided</h2>
<?php 
$validTest = array("courseName" => "Calculus3", "subject" => "");
$s1 = new TutorFinder($validTest);
echo 'Number of errors: '.$s1->getErrorCount().'<br>';
?>
</body>
</html>
