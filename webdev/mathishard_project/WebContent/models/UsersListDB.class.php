<?php
class UsersListDB {
	
	public static function getRecentlyAdded(){
		$users = UsersListDB::getAllUsers2();
		$len = count($users);
		$index = $len-1;
		$ret = array($users[$index],$users[$index-1],$users[$index-2]);
		return $ret;
	}
	public static function updateUser($name, $nameval, $userId){

		
		$query = 'UPDATE 
           Users
        SET
           '.$name."=:".$name.'
        WHERE
           userId=:userId';
		$returnId=0;
		try {
			
			
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":userId", $userId);
			$statement->bindValue(":".$name, $nameval);
			
		
			// execute the query
			$statement->execute();
			$statement->closeCursor();
			// echo a message to say the UPDATE succeeded
			echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating user :".$e->getMessage()."</p>";
		}
	}
	public static function addUser($user) {
		// Inserts the User object $user into the Users table and returns userId
	 $query = "INSERT INTO Users ( userName, pass, firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage) VALUES
		 		(:userName, :pass, :firstName,:lastName,:email,
				:bday,:gender,:tele,:status, :userRole, :skill_level, :errColor, :linkPage)";
		$returnId = 0;
		try {
			if (is_null($user) || $user->getErrorCount() > 0)
				throw new PDOException("Invalid User object can't be inserted");
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":userName", $user->getUserName());
			$statement->bindValue(":pass", $user->getUserPass());	
			$statement->bindValue(":firstName",$user -> getFirstName());
			$statement->bindValue(":lastName", $user -> getLastName());
			$statement->bindValue(":email",$user-> getEmail());
			$statement->bindValue(":bday", $user->getBdayMonth());
			$statement->bindValue(":gender",$user->getGender());
			$statement->bindValue(":tele",$user ->getPnum());
			$statement->bindValue(":status",$user->getStatus());
			$statement->bindValue(":userRole",$user->getUserRole());
			$statement->bindValue(":skill_level",$user->getSkillLevel());
			$statement->bindValue(":errColor",$user->getErrColor());
			$statement->bindValue(":linkPage",$user->getLinkPage());
		
			//echo $statement;
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("userId");
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding user to Users ".$e->getMessage()."</p>";
		}
		return $returnId;
	}
	
	
	public static function getAllUsers2() {
		$query = "SELECT * FROM Users";
		$users = array();
		try {
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$users = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all users " . $e->getMessage () . "</p>";
		}
		return $users;
	}

	public static function getAllUsers() {
	   $query = "SELECT * FROM Users";
	   $users = array();
	   try {
	      $db = Database::getDB();
	      $statement = $db->prepare($query);
	      $statement->execute();
	      $users = UsersDB::getUsersArray ($statement->fetchAll(PDO::FETCH_ASSOC));
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all users " . $e->getMessage () . "</p>";
		}
		return $users;
	}
	
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getUsersBy($type=null, $value=null) {
		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value, '*');
		
	
		return UsersDB::getUsersArray($userRows);
		
	}
	public static function getUsersBy2($type=null, $value=null) {
		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value, '*');
	
	
		return $userRows;
	
	}
	
	
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getUserValuesBy($type, $value, $column) {
		// Returns the userId of the user whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value, $column);
		return UsersDB::getUserValues($userRows, $column);
	}
	
public static function getUserRowSetsBy($type = null, $value = null) {
		// Returns the rows of Users whose $type field has value $value
		$allowedTypes = ["userId", "userName", "email"];
		$userRowSets = array();
		try {
			$db = Database::getDB ();
			$query = "SELECT * FROM Users";
			if (!is_null($type)) {
			    if (!in_array($type, $allowedTypes))
					throw new PDOException("$type not an allowed search criterion for Users");
			    $query = $query. " WHERE ($type = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$userRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		return $userRowSets;
	}
	
	
	public static function fetchUser($type, $value){

		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value);
	//	print_r($userRows);
		return $userRows;
		#print_r($userRows);
		#return UsersDB::getUsersArray($userRows);
		
	
		
	}
	public static function fetchUserType($type){
	
		// Returns a User object whose $type field has value $value
		
		
		$userRowSets = array();
		try {
		
				$userId = $_SESSION['userListId'];
				
		
			$query = "SELECT $type FROM Users WHERE (userId = $userId)";
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":$type", $type);
			$statement->execute ();
			$userRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		if (!is_null($userRowSets) && !empty($userRowSets)){
			$userRet = $userRowSets[0];
			$ret = $userRet[$type];
		}
		else {
			$ret = "";
		}
		return $ret;
	
	
	}
	
	public static function getUsersArray($rowSets) {
		$users = array();
		foreach ($rowSets as $userRow ) {
			$user = new User($userRow);
			array_push ($users, $user );
		}
		return $users;
	}
	//will be modified later for security purposes
	public static function getPassword($userId){
		$userid = $_SESSION['userListId'];
		$usersarray = UsersDB::fetchUser('userListId',$userid);
		$user = $usersarray[0];
		$pass = trim($user['pass']);
		return $pass;
		
	}
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getUserValues($rowSets, $column) {
		// Returns an array of values from $column extracted from $rowSets
		$userValues = array();
	
		foreach ($rowSets as $userRow )  {
			$userValue = $userRow[$column];
			array_push ($userValues, $userValue);
		}
		return $userValues;
	}
}
?>