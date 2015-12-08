<?php
class TutorsListDB {
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
	
	public static function addTutorCourse($tutorId,$courseId){
		
		$query = "INSERT INTO TutorCourses ( tutorId,courseId) VALUES(:tutorId,:courseId)";
		$returnId = 0;
		try {
		
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":tutorId", $tutorId);
			$statement->bindValue(":courseId",$courseId);
		
			//echo $statement;
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("courseId");
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding user to Courses ".$e->getMessage()."</p>";
		}
		return $returnId;
		
	}
	public static function addTutor($user) {
		// Inserts the User object $user into the Users table and returns userId
	 $query = "INSERT INTO Tutors ( userId ) VALUES(:userId)";
		$returnId = 0;
		try {
			if (is_null($user) || $user->getErrorCount() > 0)
				throw new PDOException("Invalid User object can't be inserted");
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":userId", $user->getUserId());
			
		
			//echo $statement;
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("tutorId");
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding user to Users ".$e->getMessage()."</p>";
		}
		return $returnId;
	}

	
	public static function addCourse($userId){
		$query = "INSERT INTO TutorCourses ( userId ) VALUES(:userId)";
	}
	public static function getAllTutors() {
	   $query = "SELECT * FROM Tutors";
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
	public static function getTutorBy($type=null, $value=null) {
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
	
	public static function getTutorIdFromUserId($idVal){
		
		$typeAlias = array('Tutors.userId' => 'Tutors.userId');
		$type = 'userId';
		$typeValue = 'Tutors.userId';
		$tutorIdRowSets = array();
	//	echo $idVal;
		
		try{
			$db = Database::getDB ();
			$query = 'SELECT Tutors.tutorId
						FROM Tutors 
						LEFT JOIN Users
						ON Users.userId=Tutors.userId
						 ';
			
			if (!is_null($type)) {
			
				//$typeValue = (isset($typeAlias[$type]))?$typeAlias[$type]:$type;
				//	$query = $query . " WHERE TutorCourses.tutorId = 1";
				$query = $query. " WHERE ($typeValue = :$type)";
			//	echo $query;
				$statement = $db->prepare($query);
				$statement->bindParam(":$type", $idVal);
			} else
				$statement = $db->prepare($query);
			
			$statement->execute ();
			$tutorIdRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		}catch( PDOException $e){
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
				
		}
		if(!empty($tutorIdRowSets)){
			$tutor = $tutorIdRowSets[0];
			return $tutor['tutorId'];
		}else{
			return null ;
		}
		
	}
}
?>
