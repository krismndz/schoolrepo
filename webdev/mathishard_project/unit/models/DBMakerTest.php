<?php
//require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'DBMaker.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';

class DBMakerTest extends PHPUnit_Framework_TestCase {
	
  public function testValidDatabaseCreate() {
    $myDb = DBMaker::create ('ptest');
 
  }
}
?>