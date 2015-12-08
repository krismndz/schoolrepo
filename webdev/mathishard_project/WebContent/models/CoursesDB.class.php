<?php
class CoursesDB {
	
	public static function addCourse($course) {
		// Inserts the User object $user into the Courses table and returns userId
		if ($course->getErrorCount()>0){

			throw new PDOException("Cannot add a class with errors");

		}
	 $query = "INSERT INTO Courses ( subject,courseName ,courseProf ) VALUES(:subject,:courseName ,:courseProf)";
		$returnId = 0;
		try {
			
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->bindValue(":subject", $course->getSubject());
			$statement->bindValue(":courseName", $course->getCourseName());
			$statement->bindValue(":courseProf", $course->getProfessor());
		
			//echo $statement;
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("courseId");
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding user to Courses ".$e->getMessage()."</p>";
		}
		return $returnId;
	}

	
	
	public static function getTutorCourses($idval){
		
		
		$tutorCoursesRowSets = array();
		$typeAlias = array("TutorCourses.tutorId" => "tutorId");
		$type = 'tutorId';
		try {
			$db = Database::getDB ();
			$query='SELECT Courses.courseName, Courses.subject, Courses.courseProf 
					FROM Courses 
					LEFT JOIN TutorCourses 
					ON Courses.courseId=TutorCourses.courseId';
			if (!is_null($type)) {
				
				$typeValue = (isset($typeAlias[$type]))?$typeAlias[$type]:$type;
			//	$query = $query . " WHERE TutorCourses.tutorId = 1";
				$query = $query. " WHERE ($typeValue = :$type)";
				$statement = $db->prepare($query);
				$statement->bindParam(":$type", $idval);
			} else
				$statement = $db->prepare($query);
			$statement->execute ();
			$tutorCoursesRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch (Exception $e) { // Not permanent error handling
		
		}
		return $tutorCoursesRowSets;
		/**if(!empty($tutorCoursesRowSets)){
			$tutorcourses = $tutorCoursesRowSets[0];
			return $tutorcourses;
		}else{
			return null;
		}**/
		
	}
	

	public static function getAllCourses() {
	 
	   $courses = array();
	   try {
	      $db = Database::getDB();
	      $query = "SELECT * FROM Courses";
	      $statement = $db->prepare($query);
	      $statement->execute();
	      //$courses = CoursesDB::getCoursesArray ($statement->fetchAll(PDO::FETCH_ASSOC));
	      $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
	       
	      $statement->closeCursor();
		} catch (PDOException $e) { // Not permanent error handling
			echo "<p>Error getting all Courses " . $e->getMessage () . "</p>";
		}
		return $courses;
	}
	
	//TO DO: SEE WHERE FUNCTION IS USED
	public static function getCoursesBy($type=null, $value=null) {
		// Returns a User object whose $type field has value $value

		try{
		$userRows = CoursesDB::getCourseRowSetsBy($type, $value);
		}catch(PDOException $e){
			throw $e;
		}	
		return CoursesDB::getCoursesArray($userRows);
		
	}
	public static function getCoursesBy2($type=null, $value=null) {
		// Returns a User object whose $type field has value $value
		try{
		$userRows = CoursesDB::getCourseRowSetsBy($type, $value);
		}catch(PDOException $e){
			throw $e;
		}
	
		return $userRows;
	
	}
	
	
	
	public static function getCourseRowSetsBy($type = null, $value = null) {
		// Returns the rows of Courses whose $type field has value $value
		$courseRowSets = array();
		try {
			$db = Database::getDB ();
			$query = "SELECT * FROM Courses";
			if (!is_null($type)) {
			    
			    $query = $query. " WHERE ($type = :$type)";
			    $statement = $db->prepare($query);
			    $statement->bindParam(":$type", $value);
			} else 
				$statement = $db->prepare($query);
			$statement->execute ();
			$courseRowSets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$statement->closeCursor ();
		} catch (Exception $e) { // Not permanent error handling
			echo "<p>Error getting user rows by $type: " . $e->getMessage () . "</p>";
		}
		if(empty($courseRowSets)){
			throw new PDOException("Course DB returned no results");
		}

		return $courseRowSets;
	}
	
	
	
	public static function getCoursesArray($rowSets) {
		$courses = array();
		foreach ($rowSets as $courseRow ) {
			$course = new Course($courseRow);
			array_push ($courses, $course );
		}
		return $courses;
	}

}
?>
