<?php

echo '<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login</title>
</head>
<body>
<h1>Login tests</h1>
';
include_once("../models/Login.class.php");
include_once("../models/Messages.class.php");

echo'<h2>It should create a valid Login object when all input is provided</h2>';
$validTest = array("userName" => "kris", "pass" => "passtemp");
$s1 = new Login($validTest);
echo 'Login object: '.$s1.'<br>';
echo '<h2>It should create errors for an invalid login input</h2>';
$invalidTest = array("userName"=> "kris**","pass" => " ");
$s1 = new Login($invalidTest);
try{
echo 'Login object:'.$s1.'<br>';
echo 'Error Count: '.$s1->getErrorCount().'<br>';
}catch(Exception $e){
echo 'Exception caught';

}
echo'</body>
</html>';

?>
