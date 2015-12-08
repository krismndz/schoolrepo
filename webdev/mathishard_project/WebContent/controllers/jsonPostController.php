<?php
// This controller processes a POST for the userName and then randomly returns a yes or no
$users = UsersDB::getAllUsers();
$usernames = array();
foreach($users as $user){
	arraypush($usernames,$user['userName']);
}
$reply = array();
   if (!isset($_POST['userName']) || empty($_POST['userName'])) 
       $reply['error'] = 'No user name';
   else {
      $reply['userName'] = $_POST['userName'];
     
      if (array_key_exists($_POST['userName'],$usernames))
      	   $reply['exists'] = false;
      else 
      	   $reply['exists'] = true;
      if ($reply['exists'])
      	 $reply['error'] = $reply['userName']." is not a valid username";
   }
     
   echo json_encode($reply);
?>

