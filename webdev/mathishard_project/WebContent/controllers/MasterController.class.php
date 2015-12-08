
<?php
class MasterController {
	// all controllers have a run method

	public static function run($class) {

		$inputForm = ($_SERVER ["REQUEST_METHOD"] == "POST") ? $_POST : null;
		$user = new User( $inputForm );


		UserView::show ($user);

	}
}

?>
 