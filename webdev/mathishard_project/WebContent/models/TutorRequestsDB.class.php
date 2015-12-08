<?php
class TutorRequestsDB {
	public static function updateTutorViewed($requestId){
		$query = 'UPDATE
           TutorRequests
        SET
           tutorViewed=:tutorViewed
        WHERE
           requestId=:requestId';
		$returnId=0;
		try {
				
				
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":requestId", $requestId);
			$statement->bindValue(":tutorViewed", 1);
				
		
			// execute the query
			$statement->execute();
			$statement->closeCursor();
			// echo a message to say the UPDATE succeeded
			//echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating user :".$e->getMessage()."</p>";
		}
		

	}
	public function updateTutorRequest($name, $nameval, $requestId){
	$query = 'UPDATE 
           TutorRequests
        SET
           '.$name.'=:'.$name.'
        WHERE
           requestId=:requestId';
		$returnId=0;
		try {
			
			
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(':requestId', $requestId);
			$statement->bindValue(':'.$name, $nameval);
			
		
			// execute the query
			$statement->execute();
			$statement->closeCursor();
			// echo a message to say the UPDATE succeeded
			//echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating tutor request :".$e->getMessage()."</p>";
		}
	}
	public static function updateTutorResponded($requestId){
		$query = 'UPDATE
           TutorRequests
        SET
           =:tutorResponded
        WHERE
           requestId=:requestId';
		$returnId=0;
		try {
		
		
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":requestId", $requestId);
			$statement->bindValue(":tutorResponded", 1);
		
		
			// execute the query
			$statement->execute();
			$statement->closeCursor();
			// echo a message to say the UPDATE succeeded
			//echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating user :".$e->getMessage()."</p>";
		}
		
		$query = 'UPDATE
           TutorRequests
        SET
           dateResponded=:dateResponded
        WHERE
           requestId=:requestId';
		$returnId=0;
		try {
		
		
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":requestId", $requestId);
			$statement->bindValue(":dateResponded", "CURRENT_TIMESTAMP");
		
		
			// execute the query
			$statement->execute();
			$statement->closeCursor();
			// echo a message to say the UPDATE succeeded
			//echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating user :".$e->getMessage()."</p>";
		}
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
			//echo $statement->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e)
		{
			echo "<p>Error updating user :".$e->getMessage()."</p>";
		}
	}
	public static function addNewRequest($tutorRequest) {
		// Inserts the User object $user into the Users table and returns userId
	 $query = "INSERT INTO TutorRequests(studentId,tutorId,courseName,studentMessage,tutorViewed,tutorResponded,studentResponded,responseViewed,studentPhone,studentEmail) VALUES
		 		(:studentId,:tutorId,:courseName,:studentMessage,:tutorViewed,:tutorResponded,:studentResponded,:responseViewed,:studentPhone,:studentEmail)";
		try {
			if (is_null($tutorRequest) || $tutorRequest->getErrorCount() > 0)
				return $tutorRequest;
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":studentId", $tutorRequest->getStudentId());	
			$statement->bindValue(":tutorId", $tutorRequest->getTutorId());	
			$statement->bindValue(":courseName", $tutorRequest->getCourseName());
			$statement->bindValue(":studentMessage", $tutorRequest->getStudentMessage());
			
			$statement->bindValue(":tutorViewed", 0);
			$statement->bindValue(":tutorResponded", 0);
			$statement->bindValue(":studentResponded", 0);
			$statement->bindValue(":responseViewed", 0);
			$statement->bindValue(":studentPhone",$tutorRequest->getPhoneBool());
			$statement->bindValue(":studentEmail",$tutorRequest->getEmailBool());
			$statement->execute ();
			$statement->closeCursor();
			
		} catch (Exception $e) { // Not permanent error handling
			$tutorRequest->setError('requestId', 'TUTOR_REQUEST_INVALID');
			$_SESSION['tutorRequest']=serialize($tutorRequest);
		}
	
		return $tutorRequest;
	}
public static function getAllStudentRequests($studentId){
	$type='studentId';
	$query = "SELECT * FROM TutorRequests";
	$requests = array();
	try {
		$db = Database::getDB();
		 
		$query = $query. " WHERE ($type = :$type)";
		$statement = $db->prepare($query);
		$statement->bindParam(":$type", $studentId);
		$statement->execute();
		$requests =$statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
	} catch (PDOException $e) { // Not permanent error handling
		echo "<p>Error getting all users " . $e->getMessage () . "</p>";
	}
	return $requests;
}
	public static function getAllRequests($tutorId) {
		$type="tutorId";
	   $query = "SELECT * FROM TutorRequests";
	   $requests = array();
	   try {
	      $db = Database::getDB();
	      
	      $query = $query. " WHERE ($type = :$type)";
	      $statement = $db->prepare($query);
		  $statement->bindParam(":$type", $tutorId);
	      $statement->execute();
	      $requests =$statement->fetchAll(PDO::FETCH_ASSOC);
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all users " . $e->getMessage () . "</p>";
		}
		return $requests;
	}
	public static function getRequestsArray($rowSets) {
		$requests = array();
		foreach ($rowSets as $requestRow ) {
			$request= new User($requestRow);
			array_push ($requests, $request);
		}
		return $requests;
	}
	
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getUsersBy($type=null, $value=null) {
		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value);
		
	
		return UsersDB::getUsersArray($userRows);
		
	}
	public static function getRequestsBy2($type=null, $value=null) {
		// Returns a User object whose $type field has value $value
		$requestRows = TutorRequestsDB::getRequestRowSetsBy($type, $value);
	
	
		return $requestRows;
	
	}
	
	public static function getRequestRowSetsBy($type = null, $value = null) {
		// Returns the rows of Users whose $type field has value $value
	
		$requestRowSets = array();
		try {
			$db = Database::getDB ();
			$query = "SELECT * FROM TutorRequests";
			if (!is_null($type)) {
				 
				$query = $query. " WHERE ($type = :$type)";
				$statement = $db->prepare($query);
				$statement->bindParam(":$type", $value);
			} else
				$statement = $db->prepare($query);
			$statement->execute ();
			$requestRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		return $requestRowSets[0];
	}
	
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getUserValuesBy($column, $type=null, $value=null) {
		// Returns the $column of Users whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value);
		return UsersDB::getUserValues($userRows, $column);
	}
	

	
	public static function fetchUser($type, $value){

		// Returns a User object whose $type field has value $value
		$userRows = UsersDB::getUserRowSetsBy($type, $value);
		//print_r($userRows);
		return $userRows;
	
		#return UsersDB::getUsersArray($userRows);
		
	
		
	}
	public static function fetchUserType($type){
	
		// Returns a User object whose $type field has value $value
		
		
		$userRowSets = array();
		try {
			
			$userid = 'userId';
		
			$userId = $_SESSION['userId'];
		
			$query = "SELECT $type FROM Users WHERE (userId = :$userId)";
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":$type", $type);
			$statement->bindParam(":$userId", $userId);
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
	
	
	//will be modified later for security purposes
	public static function getPassword($userId){
		$userid = $_SESSION['userId'];
		$usersarray = UsersDB::fetchUser('userId',$userid);
		
		try{$user = $usersarray[0];}catch(Exception $e){}
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
