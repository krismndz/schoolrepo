<?php
class TutorFinderController {
	// all controllers have a run method
	public static function run() {
		
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$reqmethod= $_SERVER["REQUEST_METHOD"];
		
		$users = UsersDB::getUsersBy2();
		$tutors = array();
		
		foreach($users as $user){
			if($user['userRole']=="Tutor"){
				array_push($tutors,$user);
			}
		}
		$courses = CoursesDB::getAllCourses();
		$_SESSION['courses']=serialize($courses);
		$subjects = array();
		
		foreach($courses as $course){
			if(empty($sujects)){
				array_push($subjects,$course['subject']);
			}elseif(!var_dump(in_array($course['subject'],$subjects))){
				array_push($subjects,$course['subject']);
				print_r($subjects);
			}
		}
		$_SESSION['subjects']=serialize($subjects);
		$finder=null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			$finder = new TutorFinder($_POST);  
			
				
		}
		else{
			unset($_SESSION['tutorFinder']);
			unset($_SESSION['foundTutors']);
			
		}
		$_SESSION['tutorFinder']=serialize($finder);
		
		if(is_null($finder)||$finder->getErrorCount()!=0){
			TutorFinderView::showAll();
		}
		elseif($finder->getErrorCount()==0){
			$course=$finder->getCourseName();
			$allusers = UsersDB::getUsersBy2();
			$tutorUsers = array();
			foreach($allusers as $user){
				if($user['userRole']=="Tutor"){
					$tutorId = TutorsListDB::getTutorIdFromUserId($user['userId']);
					$courseArray= CoursesDB::getTutorCourses($tutorId);
					foreach($courseArray as $name){
						if($name['courseName']==$course){
							array_push($tutorUsers,$user);
							
						}
					}
					
				//	array_push($tutorUsers,$user);
				}
			}
			
			$_SESSION['foundTutors']=serialize($tutorUsers);
		
			TutorFinderView::showFoundTutor();
			//ProblemView::show();
		}
	
		
	}
	
}
?>
 