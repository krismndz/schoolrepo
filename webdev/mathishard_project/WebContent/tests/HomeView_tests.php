<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for home view</title>
</head>
<body>
<h1>Home View tests</h1>

<?php

include_once("../models/User.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/MasterView.class.php");
include_once("../models/Messages.class.php");
include_once("../models/UsersListDB.class.php");
include_once("../models/Database.class.php");
?>


<h2>It should show the homepage  for a logged out user</h2>
<?php 
$_SESSION['base']='mk_project';
HomeView::show();
?>


<h2>It should show home for a logged in student</h2>
<?php

$_SESSION['base']='mk_project';
$_SESSION['control']='';
$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
                "email" => "kris@utsa.edu", "pass" => "kris"
                , "pconf" => "kris", "bdaymonth" => "2015-7", "gender" => "Female", "lastName" => "kris"
                , "profpic" => "kris", "tele" => "1231231231", "role" => "Undergraduate"
                , "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
                , "linkPage" => "http://www.kristin.com");


$s1 = new User($validTest);
$_SESSION['user']=serialize($s1);
HomeView::show();
unset($_SESSION['user']);
?>

<h2>It should show homepage for a logged in tutor</h2>
<?php

$_SESSION['base']='mk_project';
$_SESSION['control']='';
$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
                "email" => "kris@utsa.edu", "pass" => "kris"
                , "pconf" => "kris", "bdaymonth" => "2015-7", "gender" => "Female", "lastName" => "kris"
                , "profpic" => "kris", "tele" => "1231231231", "role" => "Undergraduate"
                , "userRole" => "Tutor", "skill_level" => "It varies", "errColor" => "#ff0000"
                , "linkPage" => "http://www.kristin.com");


$s1 = new User($validTest);
$_SESSION['user']=serialize($s1);
HomeView::show();
unset($_SESSION['user']);
?>



</body>
</html>
