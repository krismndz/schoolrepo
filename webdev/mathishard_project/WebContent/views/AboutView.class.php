<?php
class AboutView{
	
	public static function show(){
		$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		$title="Mathishard About Page";
		$_SESSION['headertitle']=$title;
		$_SESSION['footertitle'] ="";
		$_SESSION['styles']=array('jumbotron.css');
		MasterView::showHeader();
		MasterView::showNavBar();
		
		AboutView::showDetails();
		MasterView::showFooter();
		MasterView::showPageEnd();
	}
	public static function showDetails(){
		echo '<div class="container">';
		echo '<div class = "jumbotron">';
		echo'<h2 class = "success">Mathishard can help you not only imporove your skills in math, but also your overall gpa!</h2>';
		echo'</div>';
		echo'</div>';
		
	}
	
}


?>