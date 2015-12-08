DROP DATABASE if EXISTS mk_projectdb;
CREATE DATABASE mk_projectdb;
USE mk_projectdb;

DROP TABLE if EXISTS Users;
CREATE TABLE Users (
  userId             int(11) NOT NULL AUTO_INCREMENT,
  userName           varchar (255) UNIQUE NOT NULL COLLATE utf8_unicode_ci,
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
  passwordHash	varchar(255) COLLATE utf8_unicode_ci,
    PRIMARY KEY (userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO Users ( userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   ('kris',  'kristin','mendoza', 'kris@me.com', 'July', 'female', 1231231231
		,'Undergraduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$jNWG.gFXgKeFE5em0NDy6u9STclaaMt8ZmmcMAhvEAUyDURVUqfy6');
INSERT INTO Users( userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ('corridon',  'cory','mckelvey', 'cory@me.com', 'Janurary', 'male', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$ZE538K5BnOFHbdy.QZg1GuZsAkJ.QVsDNxD5aKHWNGJr8hFsLc0jy');
INSERT INTO Users( userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash)VALUES 
		('funky_chicken',  'funky','chicken', 'funckychick@me.com', 'June', 'female', 3453453453
		,'Undergraduate','Student', 'It varies','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
INSERT INTO Users(userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	( 'jubilee',  'jubilee','mendoza', 'jubilee@meow.com', 'July', 'female', 1231231231
		,'Undergraduate','Student', 'Very unconfident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$Jz/c5tfviVCjS08I1n/l1uYvXvQ961uHM0cwQ0dpwfdUv.PJJq/4S');
INSERT INTO Users( userName, firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ( 'casey',  'casey','w', 'casey@me.com', 'Janurary', 'female', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
INSERT INTO Users(userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ('marcela',  'marcela','u', 'marcela@me.com', 'Janurary', 'female', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
		
INSERT INTO Users(userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ('bob',  'bob','u', 'bob@me.com', 'Janurary', 'male', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
		
INSERT INTO Users( userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ('spooky_bat', 'spooky','bat', 'spooky@bat.com', 'Janurary', 'male', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
		
INSERT INTO Users( userName,  firstName,lastName,email,
bday,gender, tele, status, userRole, skill_level, errColor, linkPage,passwordHash) VALUES 
	   	   ('spooky_pumpkin', 'spooky','pumpkin', 'spooky@pumpkin.com', 'Janurary', 'male', 2342342342
		,'Graduate','Tutor', 'Very confident','#ff0000'
		, 'http://www.linkedin.com','$2y$10$cfHSjy/OSCr0hMS4MkV3CO4aQ8xlh718ELXP6V1OCZQj0Cq/6uWgO');
		
		
		
DROP TABLE if EXISTS Courses;
CREATE TABLE Courses (
  courseId         int(11) NOT NULL AUTO_INCREMENT,
  subject 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  courseName 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  courseProf 		varchar (255) NOT NULL COLLATE utf8_unicode_ci,
  PRIMARY KEY(courseId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Calculus 1', 'na');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Calculus 2', 'na');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Calculus 3', 'na');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Linear Algebra', 'Iovino');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Foundations of Mathematics', 'na');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Foundations of Analysis', 'na');

INSERT INTO Courses(subject, courseName, courseProf)
VALUES('Math','Real Analysis 1', 'na');

DROP TABLE if EXISTS Tutors;
CREATE TABLE Tutors (
	tutorId             int(11) NOT NULL AUTO_INCREMENT,
	userId              int(11) NOT NULL ,
 	PRIMARY KEY (tutorId),
    FOREIGN KEY (userId) REFERENCES Users(userId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO Tutors(userId)VALUES 
(1);

INSERT INTO Tutors(userId)VALUES 
(2);

INSERT INTO Tutors(userId)VALUES 
(5);

INSERT INTO Tutors(userId)VALUES 
(6);
INSERT INTO Tutors(userId)VALUES 
(7);

INSERT INTO Tutors(userId)VALUES 
(8);

INSERT INTO Tutors(userId)VALUES 
(9);




DROP TABLE if EXISTS TutorCourses;
CREATE TABLE TutorCourses (
  	tutorId           int(11) NOT NULL,
	courseId          int(11) NOT NULL,
	FOREIGN KEY(tutorId) REFERENCES Tutors(tutorId),
 	FOREIGN KEY(courseId) REFERENCES Courses(courseId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(1,1);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(1,2);

INSERT INTO TutorCourses(tutorId,courseId)VALUES
(2,2);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(2,4);

INSERT INTO TutorCourses(tutorId,courseId)VALUES
(3,3);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(3,7);

INSERT INTO TutorCourses(tutorId,courseId)VALUES
(4,4);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(4,5);


INSERT INTO TutorCourses(tutorId,courseId)VALUES
(5,5);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(5,1);

INSERT INTO TutorCourses(tutorId,courseId)VALUES
(6,6);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(6,2);

INSERT INTO TutorCourses(tutorId,courseId)VALUES
(7,7);
INSERT INTO TutorCourses(tutorId,courseId)VALUES
(7,6);




DROP TABLE if EXISTS TutorRequests;
CREATE TABLE TutorRequests(
	requestId 			int(11) NOT NULL AUTO_INCREMENT,
	studentId 			int(11) NOT NULL,
	tutorId 			int(11) NOT NULL,
	courseName 			varchar (255) NOT NULL COLLATE utf8_unicode_ci,
	studentMessage		varchar (255) COLLATE utf8_unicode_ci,
	tutorMessage 		varchar (255) COLLATE utf8_unicode_ci,
	studentPhone		int (1),
	tutorPhone			int (1),
	studentEmail		int(1),
	tutorEmail			int(1),
	dateSent			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	dateReceived		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	dateResponded 		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	tutorViewed 		int(1) NOT NULL,
	tutorResponded 		int(1) NOT NULL,
	studentResponded 	int(1) NOT NULL,
	responseViewed 		int(1) NOT NULL,
	acceptRequest 		int(1),
	timesSuggestT		varchar (255) COLLATE utf8_unicode_ci,
	timesSelectS		TIMESTAMP,
	location varchar (255) COLLATE utf8_unicode_ci,
	PRIMARY KEY(requestId),
	FOREIGN KEY(tutorId) REFERENCES Users(userId),
	FOREIGN KEY(studentId) REFERENCES Users(userId)
	
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO TutorRequests(studentId, tutorId, courseName,studentMessage, tutorViewed,tutorResponded,studentResponded,responseViewed,timesSuggestT,timesSelectS,location)
VALUES( 3, 1,'Calculus 2','This is a message',0,0,0,0,'2015-12-22 10:00:00.000,2015-12-24 10:00:00.000', '2015-12-24 10:00:00.000','JPL');

DROP TABLE if EXISTS TutorSessions;
CREATE TABLE TutorSessions (
  tSessionId		int(11) NOT NULL AUTO_INCREMENT,
  requestId  		int(11) NOT NULL,
  tutorId			int(11) NOT NULL,
  studentId			int(11) NOT NULL,
  courseId        	int(11) NOT NULL,
  date_time			TIMESTAMP,
  location 			varchar (255) COLLATE utf8_unicode_ci,
  PRIMARY KEY (tSessionId),
   FOREIGN KEY (requestId) REFERENCES TutorRequests(requestId),
   FOREIGN KEY (tutorId) REFERENCES Tutors(tutorId),
   FOREIGN KEY (studentId) REFERENCES Users(userId),
   FOREIGN KEY (courseId) REFERENCES Courses(courseId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO TutorSessions(requestId,tutorId, studentId, courseId, date_time,location)VALUES
( 1,1,3, 1, '2015-12-24 10:00:00.000','JPL');

DROP TABLE if EXISTS SessionMembers;
CREATE TABLE SessionMembers (

  	tSessionId          int(11) NOT NULL,
  	studentId           int(11) NOT NULL,

   FOREIGN KEY (tSessionId) REFERENCES TutorSessions(tSessionId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO SessionMembers( tSessionId, studentId)VALUES
(1,3);







