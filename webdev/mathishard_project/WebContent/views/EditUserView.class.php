<?php
class EditUserView {
	
public static function show($type=null){
	$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
	$title = $user->getFullName();
	$_SESSION['headertitle']=$title;
	$_SESSION['footertitle'] ="";
	
	$_SESSION['jscript']=array('userview.js');
	$_SESSION['styles'] = array('userview.css','jumbotron.css');
	MasterView::showHeader();
	MasterView::showNavBar();
	if(!is_null($type)){
		if($type=="pass"){
			EditUserView::editPassword();
		}
	}else{
		EditUserView::showDetails();
	}
	MasterView::showFooter();
}
  public static function showDetails() {  
  	$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
  	$updateuser = (array_key_exists('updateuser', $_SESSION))?unserialize($_SESSION['updateuser']):null;
//  	echo(get_class($user))."<br>";
 // 	echo(get_class($updateuser));
  	$keys=array('email','pass','tele','status','userRole','skill_level','errColor','linkPage');
  	
 // 	if(!is_null($updateuser)){print_r($updateuser->getEmail())."<br>";}
 // 	print_r($user->getEmail());
  	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_lab4";
  	echo'<div class="container">
	<div class = "wrapper">
	<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	<div class="panel panel-info">
  			<form role="form" method="post" action="/'.$base.'/edituser/all">';
  	
  	echo'<section>
		<header><h1>Edit Profile</h1></header>';

	
  	
  	 
  	

  	echo'<div class = "page-content container">
  	
  	<section>
  	';  	
  			echo'<h1>';
  	if (!is_null($user)) {
  		echo $user->getFullName();
  	}
  	echo'</h1>
  	<img src="user.png" alt="User Picture" width = "128" height = "128" ><br>
  	';echo'
	<!--<br>
	Profile Picture
	<input type="file" name = "profpic" tabindex ="12">
	<br>-->';
  	
  	//-------------------------------------------------------
  	echo'	<div class="form-group">
  			<div class = "row">
				<div class="col-sm-4">
				<h4>E-mail</h4><input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" ';
  	
  	if (is_null($updateuser))
  	{

  		echo 'value = "'. $user->getEmail() .'"';
  		
  	}
  	else {
  		echo 'value = "'. $updateuser->getEmail() .'"';
  	}
  	echo'>';
  	if(!is_null($updateuser)){
  		self::sendError($updateuser,'email');
  	}
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';

  	
  //-------------------------------------------------------------
	
			echo'		<div class="form-group">
						<div class = "row">
				<div class="col-sm-4">
			
					
					<h4>Phone Number</h4><input type="tel" name ="tele" class="form-control input-sm" placeholder="Phone number" ';
  	
  	
  	if (is_null($updateuser))
  	{
  		echo 'value = "'. $user->getPnum() .'"';
  	}
  	else{
  		echo 'value = "'. $updateuser->getPnum() .'"';
  	}
  	echo'>';
  	if(!is_null($updateuser)){
  		self::sendError($updateuser,'tele');
  	}
  	
  	echo'</div>';
  	echo'</div>'; 
  	echo'</div>';
  
  	//---------------------------
  	echo'
<div class="form-group">
				<div class = "row">
				<div class ="col-sm-4">
<h4>Student Status</h4>';
  	echo'<div class="dropdown">';
	
  	
  	echo'<select name="status" id="status" class="form-control input-sm">';
  	echo'<option value = ""></option>';
	echo'<option value="Undergraduate"';
  	if (is_null($updateuser)){
  		echo $user->getStatus()=='Undergraduate'?'selected':'';
  	}
  	else{
  		echo $updateuser->getStatus()=='Undergraduate'?'selected':'';
  	}
  	echo' >Undergraduate</option>';
		 echo'<option value="Graduate"';
  	if (is_null($updateuser)) {
  		echo $user->getStatus()=='Graduate'?'selected':'';
  	}else{
  		echo $updateuser->getStatus()=='Graduate'?'selected':'';
  	}
  	echo' >Graduate</option></select>';
  	if(!is_null($updateuser)){
  		self::sendError($updateuser,'status');
  	}

  	echo'</div>';
  	echo'</div></div>';
  	

	
  	
	//---------------------------------------------	
		
		echo'
<div class="form-group">
				<div class = "row">
				<div class ="col-sm-4">
<h4>How confident are you in your mathematics courses?</h4>';
		
		
		
		echo'<div class="dropdown">';
		echo'<select name="skill_level" id="skill_level" value="Select one" class="form-control input-sm">';
	echo'<option value = ""></option>';
	
	
    echo'<option  value="Very unconfident"';
  	if (is_null($updateuser)) {
  		echo $user->getSkillLevel()=='Very unconfident'?'selected':'';
  	}else{
  		echo $updateuser->getSkillLevel()=='Very unconfident'?'selected':'';
  	}
  	echo'>Very unconfident</option>';
		
  	
	echo'<option value="Somewhat unconfident"';
  	if (is_null($updateuser)) {
  		echo $user->getSkillLevel()=='Somewhat unconfident'?'selected':'';
  	}else{
  		echo $updateuser->getSkillLevel()=='Somewhat unconfident'?'selected':'';
  		
  	}
 echo'>Somewhat unconfident</option>';
		
	echo'<option value="It varies"';
  	if (is_null($updateuser)) {
  		echo $user->getSkillLevel()=='It varies'?'selected':'';
  	}
  	else{
  		echo $updateuser->getSkillLevel()=='It varies'?'selected':'';
  	}
	echo'>It varies</option>';
	
	echo'<option value="Somewhat confident"';
  	if (is_null($updateuser)) {
  		echo $user->getSkillLevel()=='Somewhat confident'?'selected':'';
  	}else{
  		echo $updateuser->getSkillLevel()=='Somewhat confident'?'selected':'';
  		
  	}
  	echo'>Somewhat confident</option>';
  	
  	
	echo'<option value="Very confident"';
  	if (is_null($updateuser)) {
  		echo $user->getSkillLevel()=='Very confident'?'selected':'';
  	}
  	else{
  		echo $updateuser->getSkillLevel()=='Very confident'?'selected':'';
  		
  	}
  	echo'>Very confident</option>';

  	echo'</select>';
  	self::sendError($updateuser,'skill_level');
  	echo'
  	</div>
		';
  
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';

  	//-----------------------------------------
  	echo'
	
	<div class = "row">
<div class="col-xs-12 col-md-2"><input type="submit" name="submitHTML5" value="Save" class="btn btn-success btn-block btn-sm" tabindex="7"></div>
				<div class="col-xs-12 col-md-2"><a href="/'.$base.'/edituser/password" class="btn btn-primary btn-block btn-sm">Change Password</a></div>
  	</div>';
  	
  	echo'</form>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	
  }
  
  
  public static function editPassword(){
  	$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
  	$updateuser = (array_key_exists('updateuser', $_SESSION))?unserialize($_SESSION['updateuser']):null;
  	
  	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_lab4";
  	echo'<div class="container">
	<div class = "wrapper">
	<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	    <div class="panel panel-info">
  			<form role="form" method="post" action="/'.$base.'/edituser/password">';
  	
  

  //-----------------------------------------------------
  	echo'	<header><h1>Change Password</h1></header>';
echo'<div class="row">
<div class="col-sm-6">
<div class="form-group">
Old Password<input type="password" name="pass" id="pass" class="form-control input-sm" placeholder="Current Password"';
  	if (!is_null($updateuser))
  	{
  		echo 'value = "'. $updateuser->getPassword() .'"';
  	}
  	echo'>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	self::sendError($updateuser,'pass');
  	
  	//-----------------------------------------------------
  	
  	
  	echo'<div class="row">
<div class="col-sm-6">
<div class="form-group">
Choose New Password<input type="password" name="newpass" id="newpass" class="form-control input-sm" placeholder="New Password"';
  	if (!is_null($updateuser))
  	{
  		echo 'value = "'. $updateuser->getNewPassword() .'"';
  	}
  	echo'>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	self::sendError($updateuser,'newpass');
  	 
  	//-----------------------------------------------------
  	
  	

  	echo'<div class="row">
<div class="col-sm-6">
<div class="form-group">
Confirm New Password<input type="password" name="newpconf" id="newpconf" class="form-control input-sm" placeholder="Confirm New Password"';
  	if (!is_null($updateuser))
  	{
  		echo 'value = "'. $updateuser->getNewPasswordConf() .'"';
  	}
  	echo'>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	self::sendError($updateuser,'newpconf');
  	 
  	//-----------------------------------------------------
  	echo'<div class = "row">
  			<div class="col-xs-12 col-md-3"><input type="submit" name="submitHTML5" value="Save" class="btn btn-success btn-block btn-sm" tabindex="7"></div>
<div class="col-xs-12 col-md-3"><a href="/'.$base.'/edituser/" class="btn btn-primary btn-block btn-sm">Back</a></div>
  	</div>';
  
  	//-----------------------------------------------------
  	echo'</form>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';
  	echo'</div>';  	
  	echo'</div>';
  	echo'</div>';
  	
  	
  }
  
  
  public static function sendError($user, $name){
  	if (!is_null($user) && !empty($user->getError($name))) {
  		echo'<div class="alert alert-danger" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
  		echo'<strong>Error: </strong>';
  		echo $user->getError($name);
  		echo '</div>';
  	}
  }
  
  
  
}




?>

