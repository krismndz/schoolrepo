<?php
class TutorEditView {
	
  
  	public static function show($courseArray=null) {
  		
  		$_SESSION['headertitle']="Tutor Course Add Page";
  	
  		MasterView::showHeader();
  		MasterView::showNavbar();
  		TutorEditView::showDetails($courseArray);
  		MasterView::showFooter();
  		MasterView::showPageEnd();
  	
  	}
  	public static function showDetails($courseArray=null) {
  		echo '<div class = "container">';
  		
  		
  		
if(!is_null($courseArray)){

	
	
	echo'<section><h1>Here are the courses you already offer</h1>';
	TutorEditView::showCourses($courseArray);
}
  		
  		echo'</section>';
  		echo'<section>';
  		if(is_null($courseArray)){
  			echo '<header><h1>Start by adding subjects that you\'d like to tutor</h1></header>';
  				
  		}else{
  			echo '<header><h1>Add more subjects that you\'d like to tutor</h1></header>';
  				
  		}
  		$tutor = (array_key_exists('tutorCourse', $_SESSION))?unserialize($_SESSION['tutorCourse']):null;
  		
  		//echo '<header><h1>Add more courses here</h1></header>';
		echo'<form method="post" action = "tutoredit"><p>';
		echo '<span class="error">';
		if(!is_null($tutor) &&is_array($tutor->getErrors())){
			//	$result= $tutor ->getErrors();
			echo('<b>The form cannot be submitted until the following errors are corrected.</b><br><br>');
		
		
			/**	foreach($result as $key => $val){
			 echo '<li>'.$key.$val.'</li>';
				}
			echo('</ul></div><br />');**/
		}
		echo '</span>';
		///------------------------------new table?
		echo'<div class="form-group">';
		echo '<table class = "table">';
		echo "<thead>";
		echo '<tr class = "success"><th>Enter Course Subject</th><th>Enter Course Name</th><th>Enter Professor (optional)</th></tr>';
		echo "</thead>";
		echo "<tbody>";
		
		echo'<tr>';
		echo'<td>';
		echo'
		<input list="subject" name="subject">
		<datalist id="subject">';
		$courseArray = CoursesDB::getAllCourses();
		
		
		
		foreach($courseArray as $course) {
		
		
			echo'<option value="'.$course['subject'].'" label = "'.$course['subject'].'" >';
				
	
		}
	
		if(!is_null($tutor)){
			 echo'<option value="'.$tutor->getSubject().'" label = "'.$tutor->getSubject().'" >';

		}
		echo'
		
		</datalist>';
		if (!is_null($tutor)) {
			self::sendError($tutor, 'subject');
		}
                echo'</td>';
              
		

		echo'<td>';
		echo'
		<input list="courseName" name="courseName">
		<datalist id="courseName">
		';
		foreach($courseArray as $course) {
		
		
			echo'<option value="'.$course['courseName'].'" label = "'.$course['courseName'].'" >';
		
		
		}

		if(!is_null($tutor)){
  			echo'<option value="'.$tutor->getCourseName().'" label = "'.$tutor->getCourseName().'" >';
		}
		echo'
		</datalist>';
 
                if (!is_null($tutor)) {
                	self::sendError($tutor, 'courseName');
                }

      



echo'</td>';


echo'<td>';
		echo'
		<input list="courseProf" name="courseProf">
		<datalist id="courseProf">'; 
		
		foreach($courseArray as $course) {
		
			$prof = $course['courseProf'];
			if($prof != "na"){
				echo'<option value="'.$course['courseProf'].'" label = "'.$course['courseProf'].'" >';
				
			}
		
		
		}

		if(!is_null($tutor)){
		 	echo'<option value="'.$tutor->getProfessor().'" label = "'.$tutor->getProfessor().'" >';


		}
		echo'
		
		</datalist>';
		
	
		/**echo 'Preferred times you\'d like to tutor<input type="text" name ="tutorName" ';
		if (!is_null($tutor))
		{
			echo 'value = "'. $tutor->gettutorName() .'"';
		}
		echo '><span class="error">';
		if (!is_null($tutor)) {
			echo $tutor->getError('tutorName'), "\n";
		}
		echo '</span>**/
		echo'</td>';
		echo'</tr>';
		echo "</tbody>";
		echo "</table>";
		echo'</div>';
		
		

		echo '</p>
				
				<div class = "row">
				
			<div class="col-sm-3"> <button class="btn btn-lg btn-primary btn-block"  name="submitHTML5" value="Add" type="Submit">Add Course</button>  	</div>			
			</div>
		</form>
				
		
		
  	</section>';
		echo'</div>';

		
  	}
  	public static function showCourses($coursesArray){
  		echo'<div class = "container">';
  		echo '<table class = "table">';
  		echo "<thead>";
  		echo '<tr class = "info"><th>Course Subject</th><th>Course Name</th></tr>';
  		echo "</thead>";
  		echo "<tbody>";
  		//echo '<tr class="success">';
  		
  		
  		foreach($coursesArray as $course) {
  		
  				
  			echo '<tr>';
  			echo '<td>'.$course['subject'].'</td>';
  			echo '<td>'.$course['courseName'].'</td>';
  			
  				
  				
  			echo '</tr>';
  		}
  	//	echo'</tr>';
  		echo "</tbody>";
  		echo "</table>";
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
  
  
  
    


