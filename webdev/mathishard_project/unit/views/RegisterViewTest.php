


<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Register.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\RegisterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class RegisterViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowRegisterViewWithUser() {
  	$validTest = array("firstName" => "kris$", "lastName" => "kr", "userName" => "kri#s",
		"email" => "", "pass" => "kris"
		, "pconf" => "kris3", "bdaymonth" => "2015-7", "gender" => ""
		, "profpic" => "kris", "tele" => "12312", "role" => "Undergraduate"
		, "userRole" => "", "skill_level" => "", "errColor" => "#000000"
		, "linkPage" => "http://www.kristin.com");
	$s1 = new Register($validTest);

  	$_SESSION = array('user' => $s1, 'base' => 'mk_lab3');
  	ob_start();
  	RegisterView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a  register view with no errors when valid");
  }
  
  public function testShowRegisterViewWithNullUser() {
  	$_SESSION = array('base' => 'mk_lab3');
  	ob_start();
  	$return = LoginView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a register view with a null register object");
  }
  public function testShowRegisterWithErrors(){
  	$invalidTest = array("firstName" => "kris$", "lastName" => "kr", "userName" => "kri#s",
  			"email" => "", "pass" => "kris"
  			, "pconf" => "kris3", "bdaymonth" => "2015-7", "gender" => ""
  			, "profpic" => "kris", "tele" => "12312", "role" => "Undergraduate"
  			, "userRole" => "", "skill_level" => "", "errColor" => "#000000"
  			, "linkPage" => "http://www.kristin.com");
  	
  	
  	$s1 = new Register($invalidTest);
    $_SESSION = array('user' => $s1, 'base' => 'mk_lab3');
  	ob_start();
  	$return = RegisterView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show errors when register user is invalid");
  	
  }

}
?>