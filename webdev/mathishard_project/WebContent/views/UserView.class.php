<?php
class UserView {
	
public static function show($user=null){
	
	$title = "temp";
	if(!is_null($user)){
		$title = $user->getFullName();
	}else{
		$user = unserialize($_SESSION['user']);
		$title = $user->getFullName();
	}
	$_SESSION['headertitle']=$title;
	$_SESSION['footertitle'] ="";
	$_SESSION['jscript']=array('userview.js','jquery.magnific-popup.js','tooltip.js','popup-with-form.js','event-attributes.js');
	$_SESSION['styles'] = array('userview.css','jumbotron.css','magnific-popup.css','popupblock.css');
	
	if (!is_null($user)){
	
	}
	MasterView::showHeader();
	MasterView::showNavBar();
	
//	UserView::showDetails($user);
	UserView::showTest();
	MasterView::showPageEnd();
	MasterView::showFooter();
	
}
  public static function showDetails($getuser = null) {  
  	if(is_null($getuser)){
  		$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
  	}
  	else{
  		$user = $getuser;
  	}
  	echo'<div class = "page-content container">
  	
  	<section>
  	<br>
  	<br>
  	<img src="../uploads/user.png" alt="User Picture" width = "128" height = "128" ><br>
  	
  	<h1>';
  	if (!is_null($user)) {
  		echo $user->getUserName();
  	}
  	 echo'</h1><h3>';
  	if (!is_null($user)) {
  		echo $user->getUserRole();
  	} 
  echo '</h3><h2>Info</h2><h3>Student Status:</h3><p>';
   if (!is_null($user)) {
   	echo $user->getStatus();
  }
  echo'</p><h3>Confidence :</h3><p>';
  if (!is_null($user)) {
  	echo $user->getSkillLevel();
  } 

	echo'</p>
  	
  	<!--<h3>Credentials:</h3>
  	<p><a href=';
	//if (!empty($user->getLinkPage())) {echo $user->getLinkPage();}
	echo'>LinkedIn Account</a></p> -->
  	<h3>Birth Month:</h3>
  	<p>';
	if (!is_null($user)) {echo $user->getBday();} 
	echo'</p>
  	<h3>Gender:</h3>
  	<p>';
	if (!is_null($user)) {echo $user->getGender();} 
	echo'</p>
  	<h3>Phone Number:</h3>
  	<p>';
	 if (!is_null($user)) {echo $user->getPnum();} 
	 echo'</p>
  	<h3>Email:</h3>
  	<p><a href=';
	 if (!is_null($user)) {echo $user->getEmail();} 
	 echo'>';
	 if (!is_null($user)) {echo $user->getEmail();} 
	 echo'</a></p>
  	</section>
  	</div>';
	
  }
  
  public static function showTest($getuser=null){
  	$base =(array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
  	if(is_null($getuser)){
  		$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		$userId = (array_key_exists('userId', $_SESSION))?$_SESSION['userId']:null;
  		
  	}
  	echo'<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <!--    <A href="edit.html" >Edit Profile</A>

        <a href="/'.$base.'/edituser" >Edit Profile</A>-->
       <br>
<p class=" text-info"><!--May 05,2014,03:00 pm--> </p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h1 class="panel-title">';
  	if (!is_null($user)) {
  		echo $user->getFullName();
  	}
              
              echo'</h1>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="uploads\user.png" class="img-circle img-responsive"> </div>
                
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><h3>';
                    if (!is_null($user)) {
                    	echo $user->getUserRole();
                    }
                        
                        echo'</h3></td>
                        <td>';
                        
                   
                        echo'</td>
                      </tr>
                      <tr><td>';
                      if(!is_null($user) && $user->getUserRole()=="Tutor"){
                      	echo 'Courses I Tutor:';
                      }
                      echo'
                        </td><td>
                        ';
  	if(!is_null($user) && $user->getUserRole()=="Tutor"){
			$tutorId = TutorsListDB::getTutorIdFromUserId($user->getUserId());
			$courseArray= CoursesDB::getTutorCourses($tutorId);
			if(empty($courseArray)){
				echo 'Sorry, no courses specified yet';
			}
			else{
				foreach($courseArray as $course) {
		
		
					 
					echo $course['subject'].', '.$course['courseName'];
		
		
		
					echo '<br>';
					 
				}
			}
	
		}
                     
                        //if tutor, enter courses here
                      echo'
                      </td></tr>';
                      
                     echo' <tr>
                      <td>Student Status</td>
                      <td>';
                      
                        if (!is_null($user)) {
                        	echo $user->getStatus();
                        }
                      
                        echo'</td>
                                              </tr>';
                      
                      echo'
                      <tr>
                        <td>Birthday</td>
                        <td>';
                    if (!is_null($user)) {echo $user->getBday();}
                        echo'</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Gender</td>
                        <td>';
                        
                    if (!is_null($user)) {echo $user->getGender();}
                        echo'</td>
                      </tr>
                       
                      <tr>
                        <td>Email</td>
                        <td><a href="';
              if (!is_null($user)) {echo $user->getEmail();}
                        echo'">';	 if (!is_null($user)) {echo $user->getEmail();} 
                        echo'</a></td>
                      </tr>
                        <td>Phone Number</td>
                        <td>';
                        if (!is_null($user)) {echo $user->getPnum();}
                        
                        echo'
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>';
                  
                 
 				if(!is_null($user)){
                 	if($userId == $user->getUserId()){
                 		echo'<div class = "container">';
                 		echo'  <a href="/mk_project/user/requests" class="btn btn-primary" data-toggle="tooltip" title="View Tutor Requests" type="button">View Requests</a>
                 		';
                 		echo'</div>';	
                 		
                 		
       
                 		
                
   							
                 			echo'	<!--<a href="#" class="btn btn-primary" data-toggle="tooltip" title="View Tutor Requests"  type="button" >View Requests</a>-->';
        
                 	}elseif($userId != $user->getUserId()){
                 		echo' <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Request help from tutor"  type="button" >Request Tutoring</a>';
                 		
                 	}
                 }
                 
             echo'   </div>
              </div>
            </div>
                 <div class="panel-footer">';
                 
                 echo'
      
    <a href="/'.$base.'/edituser"  data-toggle="tooltip"  title="Edit Profile" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>';
                        
                        echo'   <span class="pull-right"> ';
                 if(!is_null($user)){
                 	if($userId == $user->getUserId()){
                 		echo' <!--<a href="/'.$base.'/edituser"  data-toggle="tooltip"  title="Edit Profile" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>-->
                           ';
                 		
        
                 	}else{
                 		echo' <a title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                 	}
                 }
                 
  
                 echo'
                     
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>';	 		echo'';
                 		 echo'<script>$(document).ready(function(){
   						 $(\'[data-toggle="tooltip"]\').tooltip();   
						});</script>';
  }
  
 
  public static function showAll() {
  	// SHow a table of users with links
  	if (array_key_exists('headertitle', $_SESSION)) {
  		MasterView::showHeader();
  		MasterView::showNavbar();
  	}
  	$users = (array_key_exists('users', $_SESSION))?$_SESSION['users']:array();
  	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
  	
  	echo "<h1>Mathishard user list</h1>";
  	echo "<table>";
  	echo "<thead>";
  	echo "<tr><th>User Id</th><th>User name</th> <th>Profile</th></tr>";
  	echo "</thead>";
  	echo "<tbody>";
 
  	foreach($users as $user) {
  		$userId = $user['userId'];
  		$_SESSION['tempUserId']=$userId;
  		$user = new User($user);
  		
  		
  	
  	//	echo $userId."<br>";
  		echo '<tr>';
  		echo '<td>'.$userId.'</td>';
  		echo '<td>'.$user->getUserName($userId).'</td>';
  		echo '<td><a href="/'.$base.'/user/show/'.$userId.'">View</a></td>';
  		echo '</tr>';
  		unset($_SESSION['tempId']);
  
  	}
  	echo "</tbody>";
  	echo "</table>";
  	if (array_key_exists('footertitle', $_SESSION))
  		MasterView::showFooter();
  }
  
  public function showRequests(){
  	
  	$_SESSION['jscript']=array('userview.js','jquery.magnific-popup.js','tooltip.js','popup-with-form.js','event-attributes.js');
  	$_SESSION['styles'] = array('userview.css','jumbotron.css','magnific-popup.css','popupblock.css');
  	MasterView::showHeader();
  	MasterView::showNavBar();
  	$requests = (array_key_exists('requests', $_SESSION))?$_SESSION['requests']:array();
  	echo'<div class = "container">
  ';
  	if(!empty($requests)){
  		$new =0;
  		foreach($requests as $request){
  			if($request['tutorViewed']==0){
  				$new++;
  				TutorRequestsDB::updateTutorViewed($request['requestId']);
  				TutorRequestsDB::updateTutorRequest('dateReceived','CURRENT_TIMESTAMP',$request['requestId']);
  			}
  		}
  		if($new !=0){
  			echo'<h1>You have '.$new.' new ';
  		
  			if($new>1){
  				echo'requests';
  			}
  			else{
  				echo'request';
  			}
  			echo'</h1>';
  			
  			
  		}else{
  			echo'<h1>No new requests</h1>';
  		}
  	
  		echo '<table class = "table">';
  		echo "<thead>";
  		echo '<tr class = "info"><th>From</th><th>Sent</th> <th>Course</th><th>Best time to contact</th><th>Profile</th><th>Respond</th><th>Contact</th></tr>';
  		echo "</thead>";
  		echo "<tbody>";
  		
  		foreach($requests as $request) {
  			
  			$student=UsersDB::getUsersBy2('userId',$request['studentId']);
  			$studentArray=$student[0];
  			$name=$studentArray['firstName'].' '.$studentArray['lastName'];
  			$contact="";
  			if($request['studentPhone']=="1"&&$request['studentEmail']=="1"){
  				$contact='Phone or E-mail:'.$studentArray['tele'].' or '.$studentArray['email'];
  			}elseif($request['studentPhone']=="1"){
  				$contact='Phone: '.$studentArray['tele'];
  			}elseif($request['studentEmail']=="1"){
  				$contact='E-mail '.$studentArray['email'];
  			}
  			$userId = $studentArray['userId'];
 			$date=$request['dateSent'];
  			$course=$request['courseName'];
  			$message=$request['studentMessage'];
  			//	echo $userId."<br>";
  			echo '<tr>';
  			echo '<td>'.$name.'</td>';
  			echo '<td>'.$date.'</td>';
  			echo '<td>'.$course.'</td>';
  			echo '<td>'.$message.'</td>';
  			
  			echo '<td><a href="/mk_project/userlist/show/'.$userId.'">View</a></td>';
  			echo'<td>';
  			if($request['tutorResponded']==1){
  				echo 'Responded';
  			}else{
  				echo '<a href="/mk_project/user/tutor-respond/'.$request['requestId'].'" >Respond</a>';
  			}
  			echo '</td>';
  			echo'<td>'.$contact.'</td>';
  			echo '</tr>';
  			
  		
  		}
  		echo "</tbody>";
  		echo "</table>";
  	}else{
  		echo '<h1>You do not have any requests at this time</h1>';
  	}

  	echo'</div>';
  	MasterView::showPageEnd();
  	MasterView::showFooter();
  
  }
  public static function showTutorReply(){
  	MasterView::showHeader();
  	MasterView::showNavBar();
  	$tutorreply=(array_key_exists('tutorResponse',$_SESSION))?unserialize($_SESSION['tutorResponse']):null;
  	echo '<div class = "container">';
  	echo '<div class = "mfp-content">';
  	echo '<form role = "form" id="respondrequest" method ="post" class="white-popup-block" action="/mk_project/user/respondrequest/';
  	
  	'">';echo '<h1>Tutor Respond Form</h1>';
  	echo '<fieldset style="border:0;">';
  	echo '<p><h1>Please fill in all required feilds in order to submit your request.</h1></p>';
  	echo '<ol>';
  	echo '<li>';
  	echo '<label for="RequestAccept">Accept/Decline Request</label>';
  	echo '<select id="acceptRequest" name="acceptRequest" value="acceptRequest" class="form-control" onblur="checkRequest()">';
  	echo '<option value="" selected></option>';
  	echo '<option value="Accept">Accept</option>';
  	echo '<option value="Decline">Decline</option>';
  	echo '<div id="feedbackRequestAccept"></div>';
  	echo '</select>';
  	if(!is_null($tutorreply)){
  		self::sendError($tutorreply,'acceptRequest');
  	}
  	echo '</li>';

  	echo '<li>';
  echo'<label for="contact">Best way to contact me:</label>';
						echo'<select id ="contact" name="contact">';
						echo'<option value= ""></option>';
						echo'<option value="Phone">Phone</option>';
						echo'<option value="E-mail">E-mail</option>';
						echo'<option value="Both">Both</option>';
						echo'</select>';
	if(!is_null($tutorreply)){
		self::sendError($tutorreply,'contact');
	}
						 
  	echo '</li>';
  	echo '<li>';
  	echo '<label for="textarea">Message (optional)</label><br>';
  	echo '<textarea id="textarea" name="tutorMessage"></textarea>';
  	if(!is_null($tutorreply)){
  		self::sendError($tutorreply,'tutorMessage');
  	}
  	echo '</li>';
  	echo '</ol></fieldset>';
  	echo '<div class="row">';
  	echo '<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Submit Request" class="btn btn-success btn-lg"></div></div>';
  	echo '</form></div>';
  	echo'</div>';
  	
  	MasterView::showPageEnd();
  	MasterView::showFooter();
  }
  
  public static function tutorResponseSent(){
  MasterView::showHeader();
	MasterView::showNavBar();
  	
  	
  	echo '<div class="container">';
  	echo'<h1>Thanks for </h1>';
  	
  	echo '</div>';
  	MasterView::showPageEnd();
  	MasterView::showFooter();
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

