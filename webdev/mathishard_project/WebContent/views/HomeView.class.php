<?php
class HomeView {
	
	public static function show() {
		$_SESSION['headertitle']="Mathishard Homepage";
		$_SESSION['footertitle'] ="";
  	  $_SESSION['styles'] = array('jumbotron.css','home.css');
	
  	  MasterView::showHeader();
		MasterView::showNavbar();
		HomeView::showDetails();
		MasterView::showFooter();
		MasterView::showPageEnd();
	}
  public static function showDetails() {  
  	echo '<div class="container">';
  	echo '<div class="jumbotron">';
  	echo'<h1>MathIsHard</h1>';
  	echo '<p><aside><h3>College can be stressful enough. We believe that finding help shouldn\'t be.</h3></aside></p>';
  	echo'<p><uL><li><h4>Find tutors instantly with our course-based tutor searching</h4></li>
  	<li><h4>Get one-on-one help from students who have previously passed the courses you are currently taking</h4></li>
  	<li><h4>Take control of your weaknesses in math and find a tutor today!</h4></li></uL></p>
  	</section>';
  	$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:'mk_project';
  	$user = (array_key_exists('user', $_SESSION))?$_SESSION['user']:null;
  	if(is_null($user)){
  		echo '<p><a class="btn btn-info btn-lg" href="/'.$base.'/register/form1" role="button">Start now! &raquo;</a></p>';
  	}
  	echo '</div>';
  	echo '</div>';
  	
  	echo'<div class = "container">';
  	echo'<br><br>';
  	echo '<div class ="row">';
  	
  	echo'<div class="col-xs-12 col-sm-3"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><br><a href="/'.$base.'/userlist/tutors" type="submit" class="btn btn-minimal btn-lg">Find Tutors!</a></div>';
  	echo'<div class="col-xs-12 col-sm-3"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span><br><a href="/'.$base.'/about" type="submit" class="btn btn-minimal btn-lg">Improve your grades!</a></div>';
  	echo'<div class="col-xs-12 col-sm-3"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span><br><a href="/'.$base.'/register/form1" type="submit" class="btn btn-minimal btn-lg">Become a Tutor!</a></div>';
  	echo'<div class="col-xs-12 col-sm-3"><span class="glyphicon glyphicon-play" aria-hidden="true"><br></span><a href="/'.$base.'/tests.html" type="submit" class="btn btn-minimal btn-lg">Run Tests!</a></div>';
  	echo'</div>';
  	echo'<br><br>';
  	echo'</div>';
  //	$recent = UsersListDB::getRecentlyAdded();
  /**	echo '<div class="container">';
  	echo '<h1>Mathishard Recently Added Users</h1>';
  	echo '<div class="row">';
  	echo '<div class="col-md-3">';

  	echo "<thead>";
  	echo "<tr><th>Name</th><th>User name</th> <th>Profile</th><th>Email</th></tr>";
  	echo "</thead>";
  	echo "<tbody>";
  	
  
 
  	
  	foreach($recent as $user) {
  	
  			
  		echo '<tr>';
  		echo '<td>'.$user['firstName'].' '.$user['lastName'].'</td>';
  		echo '<td>'.$user['userName'].'</td>';
  		echo '<td><a href="/'.$base.'/userlist/show/'.$user['userId'].'">View</a></td>';
  		echo '<td><a href="mailto\\'.$user['email'].'\\">'.$user['email'].'</a></td>';
  			
  			
  		echo '</tr>';
  	}
  	echo "</tbody>";
  	echo "</table></div>**/
  	echo'</div></div>';
 //print_r($recent);
  }
 
}
?>



