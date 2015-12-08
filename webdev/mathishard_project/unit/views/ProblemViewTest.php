
<?php

require_once dirname(__FILE__).'\..\..\WebContent\views\ProblemView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class ProblemViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowProblemSubmitViewWithUser() {

  	$_SESSION = array( 'base' => 'mk_lab3');
  	ob_start();
  	ProblemView::show();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a problem submit page view when passed a valid user");
  }
  


}
?>