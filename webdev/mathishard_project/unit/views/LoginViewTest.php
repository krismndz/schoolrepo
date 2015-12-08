
<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\LoginView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class LoginViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowLoginViewWithUser() {
	$validTest = array("userName" => "kris", "pass" => "kris");
  	$s1 = new Login($validTest);
  	$_SESSION = array('user' => $s1, 'base' => 'mk_lab3');
  	ob_start();
  	LoginView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a valid user");
  }
  
  public function testShowLoginViewWithNullUser() {
  	$_SESSION = array('base' => 'mk_lab3');
  	ob_start();
  	$return = LoginView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a null user");
  }

}
?>