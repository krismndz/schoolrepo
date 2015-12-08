
<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\TutorFinder.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\TutorFinderView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class TutorFinderViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowLoginViewWithUser() {
	$validTest = array("userName" => "kris", "prob" => "problem description");
	$s1 = new TutorFinder($validTest);
  	$_SESSION = array('prob' => $s1, 'base' => 'mk_lab3');
  	ob_start();
  	TutorFinderView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a valid user");
  }
  
  public function testShowTutorFinderViewWithNullInput() {
  	$_SESSION = array('base' => 'mk_lab3');
  	ob_start();
  	$return = TutorFinderView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a Login view when passed a null user");
  }
  
  public function testShowTutorFinderWithErrors(){
  	$validTest = array("userName" => "kris$", "prob" => " ");
  	$s1 = new TutorFinder($validTest);
  	$_SESSION = array('prob' => $s1, 'base' => 'mk_lab3');
  	ob_start();
  	$return = RegisterView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show errors when register user is invalid");
  	 
  }

}
?>