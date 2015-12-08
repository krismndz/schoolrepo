
<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\HomeView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class HomeViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowHomeViewWithUser() {
  	ob_start();
$validTest = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
		"email" => "kris@utsa.edu", "pass" => "kris"
		, "pconf" => "kris", "bdaymonth" => "2015-7", "gender" => "Female", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "1231231231", "role" => "Undergraduate"
		, "userRole" => "Student", "skill_level" => "It varies", "errColor" => "#ff0000"
		, "linkPage" => "http://www.kristin.com");
		
  	$s1 = new Register($validTest);
  	$_SESSION = array('user' => $s1, 'base' => 'mk_lab3');
  	HomeView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a valid user");
  }
  
  public function testShowHomeViewWithNullUser() {
  	ob_start();
  	$_SESSION = array('user' => null, 'base' => 'mvcdbcrud');
  	$return = HomeView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Home view when passed a null user");
  }

}
?>