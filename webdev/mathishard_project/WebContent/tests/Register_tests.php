<?php
echo'<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Register</title>
</head>
<body>
<h1>Register tests</h1>
';
include_once("../models/Register.class.php");
include_once("../models/Messages.class.php");
echo'<h2>It should create a valid Register object when all input is provided</h2>';

$validTest= array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
                "email" => "kris@kris.com", "pass" => "kris"
                , "pconf" => "kris", "bdaymonth" => "2015-1", "gender" => "female",
                 "profpic" => "", "tele" => "1231231231", "status" => "undergraduate", "userRole" => "Tutor", "skill_level" => "Very confident", "errColor" => "#00ffff"
                , "linkPage" => "linkedin.com/kris"
);



$s1 = new Register($validTest);
echo $s1;

echo'</body>
</html>';
?>
