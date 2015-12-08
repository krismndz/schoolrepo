
<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\RegisterController.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Register.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\RegisterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\tests\DBMaker.class.php';

class RegisterControllerTest extends PHPUnit_Framework_TestCase {

//include all classes

	public function testCallRunFromPost(){
		ob_start();
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1',
				$configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_SERVER ["HTTP_HOST"] = "localhost";
		$_POST = array("firstName" => "kris", "lastName" => "kris", "userName" => "kris",
		"email" => "kris", "pass" => "kris"
		, "pconf" => "kris", "bdaymonth" => "kris", "gender" => "kris", "lastName" => "kris"
		, "profpic" => "kris", "tele" => "kris", "role" => "kris", "userRole" => "kris"
		, "userRole" => "kris", "skill_level" => "kris", "errColor" => "kris"
		, "linkPage" => "kris"
);
		$_SESSION =array('base' => 'mk_lab3');
		RegisterController::run();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a POST" );
			
			
	}
	public function testCallRunFromGet() {
			
			
		ob_start ();
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1', $configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "GET";
		$_SERVER ["HTTP_HOST"] = "localhost";
		$_SESSION =array('base' => 'mk_lab3');
			
		RegisterController::run();
		$output = ob_get_clean ();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	
	}
}


?>







