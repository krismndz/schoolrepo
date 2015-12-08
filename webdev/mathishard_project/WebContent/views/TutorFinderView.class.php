<?php  
class TutorFinderView {
	public static function show($val = null) {
		$_SESSION['headertitle'] = "Tutor Finder";
		MasterView::showHeader();
		MasterView::showNavbar();
		
		TutorFinderView::showDetails();
		$_SESSION['footertitle'] ="";
        MasterView::showFooter();
        MasterView::showPageEnd();
	}
	
	public static function showFoundTutor(){
		$foundtutors= (array_key_exists('foundTutors', $_SESSION))?unserialize($_SESSION['foundTutors']):array();
		$finder = (array_key_exists('tutorFinder', $_SESSION))?unserialize($_SESSION['tutorFinder']):null;
		
		// SHow a table of users with links
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"mk_project";
		
		echo '<div class = "container">';
		echo'<h1>Here are some tutors that can help you with '.$finder->getCourseName().' </h1>';
		echo'<h3>Feel free to check out their profiles and send them an e-mail!</h3>';
	
		echo '<table class = "table">';
		echo "<thead>";
		echo '<tr class = "danger"><th>Name</th><th>User name</th>';
		
		
		echo' <th>Profile</th><th>Email</th></tr>';
		echo "</thead>";
		echo "<tbody>";
		
		
		
		foreach($foundtutors as $user) {
		
		
			
				echo '<tr>';
				echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
				echo '<td>'.$user['userName'].'</td>';
				echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
				echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
		
		
				echo '</tr>';
		
				
		
			echo '</tr>';
		}
		echo "</tbody>";
		echo "</table></div>";
		if (array_key_exists('footertitle', $_SESSION))
			MasterView::showFooter();
	}
	public static function showAll() {
		// SHow a table of users with links
		$finder = (array_key_exists('tutorFinder', $_SESSION))?unserialize($_SESSION['tutorFinder']):null;
		if (array_key_exists('headertitle', $_SESSION)) {
			MasterView::showHeader();
			MasterView::showNavbar();
		}
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"";
		$courses=(array_key_exists('courses', $_SESSION))?unserialize($_SESSION['courses']):null;
		$subjects=(array_key_exists('subjects', $_SESSION))?unserialize($_SESSION['subjects']):null;
		echo '<div class = "container">';
		echo '<div class = "form-group">';
		echo "<h1>Mathishard Tutor Finder</h1>";
		echo '<form action = "tutorfinder" method = "post">
				
				<table class = "tutordataentry" align = "CENTER">
				<tbody>
				<tr align = "center" valign = "middle">
				<td colspan = "5" class = "dedefault">
				<br>
				<center>
				<!--<font color = "BLUE" face = "Comic Sans MS" size = 4>-->
				<b> Required Selections </b>
				</font>
				</center>
				</td>
				</tr>
				
				<tr align = "left" valign = "middle">
				<td class = "delabel" scope = "row"><!--old spot--></td>
				<td colspan = "1" class = "dedefault"><b><h4>Subject</h4></b>
				<select name = "subject" size = 6>';
				$subjects_unique = array_unique($subjects);
				echo'<option id="subject" name="subject" value = "" selected>Select One</option>';
				if(!is_null($subjects)){
					$count = 1;
					foreach ($subjects_unique as $subject){
						echo '<option id="subject" name="subject" value = "'.$subject.'"'.'>'.$subject.'</option>';
						
						
						
						
					}
				}
				
				
				
			
				echo'
				</select>';
				self::sendError($finder,'subject');
				echo'
				</td>
			
				<td class = "delabel" scope = "row"></td>
				<td colspan = "2" class = "dedefault"><b><h4>Course Name</h4></b>
				<select name = "courseName" size = 6>';
				echo'<option id="courseName" name="courseName" value = "" selected>Select One</option>';
				if(!is_null($courses)){
				
					foreach ($courses as $course){
						if(!is_null($finder)&& $finder->getCourseName()==$course['courseName']){
							echo '<option id="courseName" name="courseName" value = "'.$course['courseName'].'"'.'selected>'.$course['courseName'].'</option>';
						}else{
							echo '<option id="courseName" name="courseName" value = "'.$course['courseName'].'"'.'>'.$course['courseName'].'</option>';
						}
						
				
				
				
				
					}
				}

				echo'
				</select>';
				self::sendError($finder,'courseName');
				echo'
				</td>
			</tr>';
			
				echo'<div class="col-sm-3"> <button class="btn btn-lg btn-primary btn-block"  name="submitHTML5" value="Find Tutor" type="Submit">Find Tutor</button></div>';
			
			echo'
				</tbody>';
				
				
				
				echo'
				</table>
				<br>
						';
						
				
			
				echo'<script>
				/function loadDoc() {
				/	  var xhttp = new XMLHttpRequest();
				/	  xhttp.onreadystatechange = function() {
				/	    if (xhttp.readyState == 4 && xhttp.status == 200) {
				/	      document.getElementById("demo").innerHTML = xhttp.responseText;
				/	    }
				/	  };
				/	  xhttp.open("GET", "demo_get.asp", true);
				/	  xhttp.send();
				/	}" +
				"</script>';
				
				echo'
				<!--<input type = "submit" value = "Find Tutor">-->
				</form>';
		
		/**echo "<table>";
		echo "<thead>";
		echo "<tr><th>Name</th><th>User name</th> <th>Profile</th><th>Email</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		
		
		$userData = array();
		$users = $_SESSION['users'];
		
		foreach($users as $user) {
		
			
			echo '<tr>';
			echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
			echo '<td>'.$user['userName'].'</td>';
			echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
			echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
			
			
			echo '</tr>';
		}
		echo "</tbody>";
		echo "</table>";**/
				echo '</div>';
				echo '</div>';
		if (array_key_exists('footertitle', $_SESSION))
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

