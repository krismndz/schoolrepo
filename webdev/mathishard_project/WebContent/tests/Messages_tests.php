<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Messages tests</h1>

<?php
include_once("../models/Messages.class.php");
?>

<h2>It should set errors from a file</h2>
<?php /**
EMAIL_INVALID Your email is invalid
FIRST_NAME_EMPTY Your first name can not be empty or only contain white space
FIRST_NAME_HAS_INVALID_CHARS Your first name contains invalid characters
LAST_NAME_EMPTY Your last name can not be empty or only contain white space
LAST_NAME_HAS_INVALID_CHARS Your last name contains invalid characters
LAST_NAME_TOO_SHORT Your last name is too short
EMAIL_EMPTY You must enter your e-mail
EMAIL_INVALID_CHARS Your e-mail has invalid characters
BDAY_EMPTY You must provide your birthday month
GENDER_EMPTY You must specify your gender
PNUM_EMPTY You must provide a phone number
PNUM_TOO_SHORT Your phone number must be at least 10 digits
STATUS_EMPTY You must indicate what your student status is
USER_ROLE_EMPTY You must indicate a desired role
USER_NAME_EMPTY Your user name can not be empty or only contain white space
USER_NAME_HAS_INVALID_CHARS Your user name can only contain letters, numbers, dashes and underscores
PASSWORD_EMPTY Your password cannot be empty or whitespace only
PASSWORD_CONFIRM_EMPTY You must confirm your password
PASSWORD_NOT_MATCH 	Your passwords do not match
SKILL_EMPTY You must self identify your skill level
COLOR_EMPTY You must specify a color for errors
COLOR_DEFAULT You cannot specify black as your color
**/
Messages::setErrors("../resources/errors_English.txt");
echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_HAS_INVALID_CHARS: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "EMAIL_EMPTY: " .Messages::getError("EMAIL_EMPTY")."<br>";
echo "EMAIL_INVALID_CHARS: " .Messages::getError("EMAIL_INVALID_CHARS")."<br>";
echo "BDAY_EMPTY: " .Messages::getError("BDAY_EMPTY")."<br>";
echo "GENDER_EMPTY: " .Messages::getError("GENDER_EMPTY")."<br>";
echo "PNUM_EMPTY: " .Messages::getError("PNUM_EMPTY")."<br>";
echo "PNUM_TOO_SHORT: " .Messages::getError("PNUM_TOO_SHORT")."<br>";
echo "STATUS_EMPTY: " .Messages::getError("STATUS_EMPTY")."<br>";
echo "USER_ROLE_EMPTY: " .Messages::getError("USER_ROLE_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PASSWORD_EMPTY: " .Messages::getError("PASSWORD_EMPTY")."<br>";
echo "PASSWORD_CONFIRM_EMPTY: " .Messages::getError("PASSWORD_CONFIRM_EMPTY")."<br>";
echo "PASSWORD_NOT_MATCH: " .Messages::getError("PASSWORD_NOT_MATCH")."<br>";
echo "SKILL_EMPTY: " .Messages::getError("SKILL_EMPTY")."<br>";
echo "COLOR_EMPTY: " .Messages::getError("COLOR_EMPTY")."<br>";
echo "COLOR_DEFAULT: " .Messages::getError("COLOR_DEFAULT")."<br>";


echo (empty(Messages::getError("LAST_NAME_TOO_SHORT")))?
      "Failed: it did not set LAST_NAME_TOO_SHORT from file":"";
?>

<h2>It should allow reset</h2>
<?php 
Messages::reset();

echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_HAS_INVALID_CHARS: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "EMAIL_EMPTY: " .Messages::getError("EMAIL_EMPTY")."<br>";
echo "EMAIL_INVALID_CHARS: " .Messages::getError("EMAIL_INVALID_CHARS")."<br>";
echo "BDAY_EMPTY: " .Messages::getError("BDAY_EMPTY")."<br>";
echo "GENDER_EMPTY: " .Messages::getError("GENDER_EMPTY")."<br>";
echo "PNUM_EMPTY: " .Messages::getError("PNUM_EMPTY")."<br>";
echo "PNUM_TOO_SHORT: " .Messages::getError("PNUM_TOO_SHORT")."<br>";
echo "STATUS_EMPTY: " .Messages::getError("STATUS_EMPTY")."<br>";
echo "USER_ROLE_EMPTY: " .Messages::getError("USER_ROLE_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PASSWORD_EMPTY: " .Messages::getError("PASSWORD_EMPTY")."<br>";
echo "PASSWORD_CONFIRM_EMPTY: " .Messages::getError("PASSWORD_CONFIRM_EMPTY")."<br>";
echo "PASSWORD_NOT_MATCH: " .Messages::getError("PASSWORD_NOT_MATCH")."<br>";
echo "SKILL_EMPTY: " .Messages::getError("SKILL_EMPTY")."<br>";
echo "COLOR_EMPTY: " .Messages::getError("COLOR_EMPTY")."<br>";
echo "COLOR_DEFAULT: " .Messages::getError("COLOR_DEFAULT")."<br>";

?>

<h2>It should allow change of locale</h2>
<?php 
Messages::$locale = 'Spanish';
Messages::setErrors("../resources/errors_Spanish.txt");
Messages::reset();

echo "LAST_NAME_TOO_SHORT: " .Messages::getError("LAST_NAME_TOO_SHORT")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "LAST_NAME_INVALID: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "EMAIL_INVALID: " .Messages::getError("EMAIL_INVALID")."<br>";
echo "FIRST_NAME_HAS_INVALID_CHARS: " .Messages::getError("FIRST_NAME_HAS_INVALID_CHARS")."<br>";
echo "LAST_NAME_HAS_INVALID_CHARS: " .Messages::getError("LAST_NAME_HAS_INVALID_CHARS")."<br>";
echo "FIRST_NAME_EMPTY: " .Messages::getError("FIRST_NAME_EMPTY")."<br>";
echo "EMAIL_EMPTY: " .Messages::getError("EMAIL_EMPTY")."<br>";
echo "EMAIL_INVALID_CHARS: " .Messages::getError("EMAIL_INVALID_CHARS")."<br>";
echo "BDAY_EMPTY: " .Messages::getError("BDAY_EMPTY")."<br>";
echo "GENDER_EMPTY: " .Messages::getError("GENDER_EMPTY")."<br>";
echo "PNUM_EMPTY: " .Messages::getError("PNUM_EMPTY")."<br>";
echo "PNUM_TOO_SHORT: " .Messages::getError("PNUM_TOO_SHORT")."<br>";
echo "STATUS_EMPTY: " .Messages::getError("STATUS_EMPTY")."<br>";
echo "USER_ROLE_EMPTY: " .Messages::getError("USER_ROLE_EMPTY")."<br>";
echo "USER_NAME_EMPTY: " .Messages::getError("USER_NAME_EMPTY")."<br>";
echo "USER_NAME_HAS_INVALID_CHARS: " .Messages::getError("USER_NAME_HAS_INVALID_CHARS")."<br>";
echo "PASSWORD_EMPTY: " .Messages::getError("PASSWORD_EMPTY")."<br>";
echo "PASSWORD_CONFIRM_EMPTY: " .Messages::getError("PASSWORD_CONFIRM_EMPTY")."<br>";
echo "PASSWORD_NOT_MATCH: " .Messages::getError("PASSWORD_NOT_MATCH")."<br>";
echo "SKILL_EMPTY: " .Messages::getError("SKILL_EMPTY")."<br>";
echo "COLOR_EMPTY: " .Messages::getError("COLOR_EMPTY")."<br>";
echo "COLOR_DEFAULT: " .Messages::getError("COLOR_DEFAULT")."<br>";

?>
</body>
</html>

