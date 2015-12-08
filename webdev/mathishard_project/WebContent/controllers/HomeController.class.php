
<?php
class HomeController {
	// all controllers have a run method

	public static function run() {

		$inputForm = ($_SERVER ["REQUEST_METHOD"] == "POST") ? $_POST : null;
		$user = new User( $inputForm );


		UserView::show ($user);

	}
}

?>
 