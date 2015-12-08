

<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\TutorFinderController.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\TutorFinder.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\TutorFinderView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\tests\DBMaker.class.php';

class TutorFinderControllerTest extends PHPUnit_Framework_TestCase {
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromPost() {
		ob_start();
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1', 
				$configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_SERVER ["HTTP_HOST"] = "localhost";
		$_POST = array("userName"=>"kris", "prob"=>"This is the problem description");
		$_SESSION = array('base' => 'mk_lab3');
        TutorFinderController::run();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a POST" );
	}
	
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromGet() {
		ob_start ();
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1', $configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "GET";
		$_SERVER ["HTTP_HOST"] = "localhost";
		$_SESSION = array('base' => 'mk_lab3');

        TutorFinderController::run();
		$output = ob_get_clean ();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	}
}

?>

