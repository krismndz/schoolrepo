<?php  
class UserListView {
	public static function show($type=null) {
		$_SESSION['headertitle'] = "User details";
		$_SESSION['styles']=array('magnific-popup.css','popupblock.css');
		$_SESSION['jscript']=array('jquery.magnific-popup.js','tooltip.js','popup-with-form.js','event-attributes.js');
		MasterView::showHeader();
		MasterView::showNavbar();
		
		if(!is_null($type)&& $type=="tutors"){
			UserListView::showTutors();
		}else{
			UserListView::showTest();
		}
	//	UserListView::showDetails();
		$_SESSION['footertitle'] ="";
   
        MasterView::showPageEnd();
        MasterView::showFooter();
        
	}

	public static function showTutors(){
		$curuser = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		
		// SHow a table of users with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<div class = "container">';
		if(!is_null($curuser)){
			if($curuser->getUserRole()=="Tutor"){
				echo "<h1>Mathishard user list</h1>";
			}
			else{
				echo "<h1>Mathishard tutor list</h1>";
			}
		}else{
			echo "<h1>Mathishard user list</h1>";
		
		}
		echo '<table class = "table">';
		echo "<thead>";
		echo '<tr class = "danger"><th>Name</th><th>User name</th>';
		
		
		echo' <th>Profile</th><th>Email</th></tr>';
		echo "</thead>";
		echo "<tbody>";
		
		$userData = array();
		$users = $_SESSION['users'];
		
		foreach($users as $user) {
		
		
				if($user['userRole']=="Tutor"){
					echo '<tr>';
					echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
					echo '<td>'.$user['userName'].'</td>';
					echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
					echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
		
		
					echo '</tr>';
				}
			
				
			echo '</tr>';
		}
		echo "</tbody>";
		echo "</table></div>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	public static function showTest(){
		$userId = (array_key_exists('userId', $_SESSION))?$_SESSION['userId']:null;
		$base =(array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
		$user = (array_key_exists('userList', $_SESSION))?unserialize($_SESSION['userList']):null;
		$curuser =  (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		$userListId= (array_key_exists('userListId', $_SESSION))?$_SESSION['userListId']:null;
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
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="..\..\uploads\user.png" class="img-circle img-responsive"> </div>
	
	
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
			echo 'I can tutor students for:';
		}
		echo'
                        </td><td>
                        ';
		if(!is_null($user) && $user->getUserRole()=="Tutor"){
			$tutorId = TutorsListDB::getTutorIdFromUserId($userListId);
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
                      </tr>';
                      
                     /** echo'
            
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
              
                      </tr>';**/
                      
                      
                      echo'
           
                    </tbody>
                  </table>';
	
		 
		if(!is_null($user)&& !is_null($curuser)){
			if($userId == $user->getUserId()&&$curuser->getUserRole()=="Student"){
			
				echo'  <a href="#" class="btn btn-primary" data-toggle="tooltip" title="View Tutor Requests"  type="button" >View Requests</a>';
	
			}elseif(($userId != $user->getUserId())&& ($user->getUserRole()=="Tutor")&&($curuser->getUserRole()=="Student")){
			
				//echo'<div class = "html-code">';
				echo'<a href="#test-popup" class="open-popup-link">Click here to request this tutors help</a>
						<!--<a class="popup-with-form" href="#test-form">Open form</a>-->
						<!--<button type="button" data-theme="b" data-icon="check" data-inline="true" onclick="validLogin()">Request Tutoring</button>-->
						
						<!--<a href="#" class="btn btn-primary" data-toggle="tooltip" title="Request help from tutor"  type="button" >Request Tutoring</a>-->';
		
				

				/**echo '<form role = "form" id="test-form" method ="post" class="white-popup-block mfp-hide" action="/'.$base.'/userlist/submitrequest">';echo '<h1>Tutor Request Form</h1>';
				echo '<fieldset style="border:0;">';
				echo '<p>Please fill in all required feilds in order to submit your request.</p>';
				echo '<ol>';
				echo '<li>';
				echo '<label for="name">Name</label>';
				echo '<input id="name" name="name" type="text" placeholder="Name" required="">';
				echo '</li>';
				echo '<li>';
				echo '<label for="email">Course</label>';
				echo '<input id="email" name="email" type="email" placeholder="example: Math 3333" required="">';
				echo '</li>';
				echo '<li>';
				echo '<label for="phone">Phone (optional) </label>';
				echo '<input id="phone" name="phone" type="tel" placeholder="Eg. ;447500000000" required="">';
				echo '</li>';
				echo '<li>';
				echo '<label for="textarea">Best times to contact: </label><br>';
				echo '<textarea id="textarea">Try to resize me to see how popup CSS-based resizing works.</textarea>';
				echo '</li>';
				echo '</ol></fieldset>';
				echo '<div class="row">';
				echo '<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Submit Request" class="btn btn-success btn-lg"></div></div>';
				
				echo '</form>';**/
				//echo'</div>';
			
			
				
			}
		}
		 
		echo'   </div>
              </div>
            </div>
                 <div class="panel-footer">';
		 
		/**echo'<a title="';
		
		if(!is_null($user)){
			if($userId == $userListId){
				echo'View Messages';
			}else {
				
				echo'Send Message';
			}
		}
		echo '" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>';**/
	
		echo'   <span class="pull-right"> ';
		if(!is_null($user)){
			if($userId == $userListId){
				echo' <a href="/'.$base.'/edituser"  data-toggle="tooltip"  title="Edit Profile" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                           ';
				 
	
			}else{
				//echo' <a title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
			}
		}
		echo'
                      <!--  <a href="/'.$base.'/edituser" data-original-title="Edit Profile" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </span>
                    </div>
	
          </div>
        </div>
      </div>
    </div>';
	}
	
	public static function showAll() {
		
		$curuser = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		
		// SHow a table of users with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo '<div class = "container">';
		if(!is_null($curuser)){
			if($curuser->getUserRole()=="Tutor"){
				echo "<h1>Mathishard user list</h1>";
			}
			else{
				echo "<h1>Mathishard tutor list</h1>";
			}
		}else{
			echo "<h1>Mathishard user list</h1>";
				
		}
		echo '<table class = "table">';
		echo "<thead>";
		echo '<tr class = "danger"><th>Name</th><th>User name</th>';
		if(!is_null($curuser)&&$curuser->getUserRole()=="Tutor"){
			echo'<th>Role</th>';
		}
		
		echo' <th>Profile</th><th>Email</th></tr>';
		echo "</thead>";
		echo "<tbody>";
		
		$userData = array();
		$users = $_SESSION['users'];
		
		foreach($users as $user) {
		
			if(!is_null($curuser)&&$curuser->getUserRole()=="Student"){
				if($user['userRole']=="Tutor"){
					echo '<tr>';
					echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
					echo '<td>'.$user['userName'].'</td>';
					echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
					echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
						
						
					echo '</tr>';
				}
			}else{
			echo '<tr>';
			echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
			echo '<td>'.$user['userName'].'</td>';
			if(!is_null($curuser)&&$curuser->getUserRole()=="Tutor"){
				echo'<td>'.$user['userRole'].'</td>';
			}
			echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
			echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
		}
			
			echo '</tr>';
	}
		echo "</tbody>";
		echo "</table></div>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	
	public static function showDetails() {
		$user = (array_key_exists('userList', $_SESSION))?unserialize($_SESSION['userList']):null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		echo'<div class = "page-content container">
  
  	<section>
  	<br>
  	<br>
  	<img src="..\..\..\uploads\user.png" alt="User Picture" width = "128" height = "128" ><br>
  
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
	public static function viewRequestsSent(){
		MasterView::showHeader();
		MasterView::showNavbar();
		$request= (array_key_exists('tutorRequest', $_SESSION))?unserialize($_SESSION['tutorRequest']):null;
		$allrequests= (array_key_exists('studentRequests', $_SESSION))?unserialize($_SESSION['studentRequests']):array();
		echo'<div class="container">';
		if(!is_null($request)){
			echo '<p><h1>Thanks for submitting your request!</h1></p>';
			unset($_SESSION['tutorRequest']);
		}
		if(!empty($allrequests)){
			echo '<p><h1>Here are your current tutoring requests</h1></p>';
			echo '<table class = "table">';
			echo "<thead>";
			echo '<tr class = "info"><th>To</th><th>Read</th> <th>Course</th><th>Profile</th><th>View Response</th></tr>';
			echo "</thead>";
			echo "<tbody>";
			
			foreach($allrequests as $request) {
				$responded= $request['tutorResponded'];
				$tutor=UsersDB::getUsersBy2('userId',$request['tutorId']);
				$tutorArray=$tutor[0];
				$name=$tutorArray['firstName'].' '.$tutorArray['lastName'];
				$userId = $tutorArray['userId'];
				
				$sentdate=$request['dateReceived'];
				$course=$request['courseName'];
				$message=$request['tutorMessage'];
				//	echo $userId."<br>";
				
				$receivedBool=$request['tutorViewed'];
				$read=($receivedBool==0)?'No':'yes';
				
				echo '<tr>';
				echo '<td>'.$name.'</td>';
				echo '<td>'.$read.'</td>';
				echo '<td>'.$course.'</td>';
				
					
				echo '<td><a href="/mk_project/userlist/show/'.$userId.'">View</a></td>';
				if($responded==1){
					echo '<td><a href="/mk_project/userlist/tutor-respond/'.$request['requestId'].'" >View Response</a></td>';
				}
				
				echo '</tr>';
					
			
			}
			echo "</tbody>";
			echo "</table>";
		
		}else{
			echo '<p><h1>You have no sent tutor requests at this time</h1></p>';
		}
		
		
		echo'</div>';
		MasterView::showPageEnd();
		MasterView::showFooter();
		
	}
	public static function viewTutorRequestResponse(){
		$tutorResponse=(array_key_exists('tutorRequestView', $_SESSION))?unserialize($_SESSION['tutorRequestView']):null;
		$tutorarray = UsersDB::getUsersBy2('userId',$tutorResponse['tutorId']);
		$tutor = $tutorarray[0];
		MasterView::showHeader();
		MasterView::showNavbar();
		echo '<div class = "container">';
		echo'<p><h1>Tutor Request Response from '.$tutor['firstName'].' '.$tutor['lastName'].' for '.$tutorResponse['courseName'].'</h1></p>';
		echo '<p><label for="RequestAccept"><h3>Accept/Decline Response: </label>';
	
		if($tutorResponse['acceptRequest']=='1'){
			echo'Accepted';
		}else{
			echo'Declined';
		}
		echo'</h3></p>';
		
		
		
		echo '<p><label for="Phone number"><h3>Tutors Contact Information: </label>';
		$contact="";
  			if($tutorResponse['tutorPhone']=="1"&&$tutorResponse['tutorEmail']=="1"){
  				echo'Phone or E-mail:'.$tutor['tele'].' or '.$tutor['email'];
  			}elseif($tutorResponse['tutorPhone']=="1"){
  				echo'Phone: '.$tutor['tele'];
  			}elseif($tutorResponse['tutorEmail']=="1"){
  				echo'E-mail '.$tutor['email'];
  			}
		
		
		echo'</h3></p>';
		echo '<p><label for="TutorMessage"><h3>Best times to contact: </label>';
		echo $tutorResponse['tutorMessage'];
		
		
		echo'</h3></p>';
		
		echo'</div>';
		
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



