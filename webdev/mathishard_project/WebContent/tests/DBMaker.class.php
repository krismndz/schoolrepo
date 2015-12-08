<?php

class DBMaker {
	public static function create($dbName) {
		// Creates a database named $dbName for testing and returns connection
		$db = null;
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . "". ";charset=utf8";
			$username = 'root';
			$password = '';
			//$password = 'corridon';
			$options = array (
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			);
			$db = new PDO ( $dbspec, $username, $password, $options );
			$st = $db->prepare ( "DROP DATABASE if EXISTS $dbName" );
			$st->execute ();
			$st = $db->prepare ( "CREATE DATABASE $dbName" );
			$st->execute ();
			$st = $db->prepare ( "USE $dbName" );
			$st->execute ();
			$st = $db->prepare ( "DROP TABLE if EXISTS Users" );
			$st->execute ();
			$st = $db->prepare ( "CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
  pass           varchar(255) COLLATE utf8_unicode_ci,
  firstName           varchar(255) COLLATE utf8_unicode_ci,
  lastName           varchar(255) COLLATE utf8_unicode_ci,
  email           varchar(255) COLLATE utf8_unicode_ci,
  bday           varchar(255) COLLATE utf8_unicode_ci,
  gender           varchar(255) COLLATE utf8_unicode_ci,
  tele 	 			int(11) NOT NULL,
  status			varchar(255) COLLATE utf8_unicode_ci,
  userRole			varchar(255) COLLATE utf8_unicode_ci,
  skill_level			varchar(255) COLLATE utf8_unicode_ci,
  errColor			varchar(255) COLLATE utf8_unicode_ci,
  linkPage			varchar(255) COLLATE utf8_unicode_ci,
  userDateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  passwordHash varchar(255) COLLATE utf8_unicode_ci,
    PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			$st = $db->prepare ( "DROP TABLE if EXISTS Courses;" );
			$st->execute ();
			$st = $db->prepare ("CREATE TABLE Courses (
  courseId         int(11) NOT NULL AUTO_INCREMENT,
  subject 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  courseName 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  courseProf 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  PRIMARY KEY(courseId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;" );
			$st->execute ();
			
			$st = $db->prepare ("DROP TABLE if EXISTS Tutors");
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE Tutors (
	tutorId             int(11) NOT NULL AUTO_INCREMENT,
	userId              int(11) NOT NULL ,
 	PRIMARY KEY (tutorId),
    FOREIGN KEY (userId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
					        );
			$st->execute ();
			
			
			$st = $db->prepare ("DROP TABLE if EXISTS TutorSessions");
			$st->execute ();
			
			$st = $db->prepare ("CREATE TABLE TutorSessions (
  tSessionId             int(11) NOT NULL AUTO_INCREMENT,
  tutorId             int(11) NOT NULL,
  courseId          int(11) NOT NULL,
  problems           varchar (255) COLLATE utf8_unicode_ci,
  datetime 			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (tSessionId),
   FOREIGN KEY (tutorId) REFERENCES Tutors(tutorId),
   FOREIGN KEY (courseId) REFERENCES Courses(courseId)

)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
			);
			$st->execute ();
			
			$st = $db->prepare("DROP TABLE if EXISTS TutorCourses;");
			$st->execute ();
			$st = $db->prepare ("CREATE TABLE TutorCourses (
					tutorId           int(11) NOT NULL,
					courseId          int(11) NOT NULL,
					FOREIGN KEY(tutorId) REFERENCES Tutors(tutorId),
					FOREIGN KEY(courseId) REFERENCES Courses(courseId)
			)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
			$st->execute ();
			
			
			
			$st = $db->prepare ("DROP TABLE if EXISTS SessionMembers");
			$st->execute ();
				
			$st = $db->prepare ("CREATE TABLE SessionMembers (

  	tSessionId          int(11) NOT NULL,
  	studentId           int(11) NOT NULL,

   FOREIGN KEY (tSessionId) REFERENCES TutorSessions(tSessionId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
			);
			$st->execute ();
			
			
		 $sql = "INSERT INTO Users (userId, userName, pass, firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES
		 		(:userId, :userName, :pass, :firstName,:lastName,:email,
				:bday,:gender,:tele,:status, :userRole, :skill_level, :errColor, :linkPage,:passwordHash)";
			$st = $db->prepare($sql);
		$st->execute(array(':userId'=>1, ':userName'=>'kris', ':pass'=>'xxx', ':firstName'=>'kristin',
				':lastName'=>'mendoza', ':email'=>'kris@me.com',':bday'=>'July', ':gender'=>'female', ':tele'=>1231231231,
				':status'=>'Undergraduate',':userRole'=>'Tutor', ':skill_level'=>'Very confident',
				':errColor'=>'#ff0000',':linkPage'=> 'http://www.linkedin.com',":passwordHash"=>password_hash("passtemp",PASSWORD_DEFAULT)));
		$st->execute(array(':userId'=>2, ':userName'=>'cory', ':pass'=>'yyy', ':firstName'=>'corridon',
				':lastName'=>'mckelvey', ':email'=>'cory@me.com',':bday'=>'Janurary', ':gender'=>'male', ':tele'=>2342342342,
				':status'=>'Graduate',':userRole'=>'Tutor', ':skill_level'=>'Very confident',
				':errColor'=>'#ff0000',':linkPage'=> 'http://www.linkedin.com',":passwordHash"=>password_hash("passtemp",PASSWORD_DEFAULT)));
		$st->execute(array(':userId'=>3, ':userName'=>'funky_chicken', ':pass'=>'zzz', ':firstName'=>'funky',
				':lastName'=>'chicken', ':email'=>'funkychicken@me.com',':bday'=>'June', ':gender'=>'female', ':tele'=>3453453453,
				'status'=>'Undergraduate','userRole'=>'Student', 'skill_level'=>'It varies',
				':errColor'=>'#ff0000',':linkPage'=> 'http://www.linkedin.com',":passwordHash"=>password_hash("passtemp",PASSWORD_DEFAULT)));
		
		$st->execute(array(':userId'=>4, ':userName'=>'jubilee', ':pass'=>'www', ':firstName'=>'jubilee',
				':lastName'=>'mendoza', ':email'=>'jubilee@meow.com',':bday'=>'July', ':gender'=>'female', ':tele'=>1231231231,
				':status'=>'Undergraduate',':userRole'=>'Student', ':skill_level'=>'Very confident',
				':errColor'=>'#ff0000',':linkPage'=> 'http://www.linkedin.com',":passwordHash"=>password_hash("passtemp",PASSWORD_DEFAULT)));
		
		
			
			$sql = "INSERT INTO Courses (subject, courseName, courseProf) 
	                             VALUES(:subject, :courseName, :courseProf) ";
			$st = $db->prepare ($sql);
			$st->execute (array (':subject'=>'Math',':courseName'=>'Calculus 3',':courseProf'=> 'Iovino'));

			$st->execute (array (':subject'=>'Math',':courseName'=>'Linear Algebra',':courseProf'=> 'na'));

			$sql = "INSERT INTO Tutors(userId)VALUES (:userId)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':userId' => 1));
			
			
			$sql = "INSERT INTO TutorCourses(tutorId,courseId)VALUES(:tutorId, :courseId)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':tutorId' => 1,':courseId'=>1));
				
			
			$sql = "INSERT INTO TutorSessions(tutorId,  courseId, problems, datetime)VALUES
					(:tutorId, :courseId, :problems, :datetime)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':tutorId'=>1, ':courseId'=>1, ':problems'=>'n/a', ':datetime'=>'2015-10-02 18:53:12.000'));
			

			$sql = "INSERT INTO SessionMembers( tSessionId, studentId)VALUES
					(:tSessionId, :studentId)";
			$st = $db->prepare ( $sql );
			$st->execute (array (':tSessionId'=>1, ':studentId'=>3));
				
			$sql = "INSERT INTO TutorCourses(tutorId,courseId)VALUES
			(:tutorId, :courseId);"	;
			$st = $db->prepare ( $sql );
			$st->execute (array (':tutorId'=>1, ':courseId'=>1));
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
		
		return $db;
	}
	public static function delete($dbName) {
		// Delete a database named $dbName
		try {
			$dbspec = 'mysql:host=localhost;dbname=' . $dbName . ";charset=utf8";
			$username = 'root';
			$password = '';
			$options = array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$db = new PDO ($dbspec, $username, $password, $options);
			$st = $db->prepare ("DROP DATABASE if EXISTS $dbName");
			$st->execute ();
		} catch ( PDOException $e ) {
			echo $e->getMessage (); // not final error handling
		}
	}
}
?>
