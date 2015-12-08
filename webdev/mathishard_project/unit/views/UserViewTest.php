

<?php

require_once dirname(__FILE__).'\..\..\WebContent\views\UserView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';

class UserViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowProblemSubmitViewWithUser() {
  	$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
  			"email" => "kris@utsa.edu", "pass" => "kris"
  			, "bdaymonth" => "2015-7", "gender" => "Female", "lastName" => "kris"
  			, "profpic" => "kris", "tele" => "1231231231", "role" => "Undergraduate"
  			, "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
  			, "linkPage" => "http://www.kristin.com");
  	
  	
  	$s1 = new User($validTest);
  	$_SESSION = array( 'base' => 'mk_lab3');
  	ob_start();
  	UserView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show the user profile");
  }
  


}
?>