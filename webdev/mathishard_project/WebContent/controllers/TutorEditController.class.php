
<?php
class TutorEditController {
	// all controllers have a run method
	

	public static function run() {
		//unset($_SESSION['tutorCourse']);
		$course = null;
		$user = unserialize($_SESSION['user']);
		
		$inputForm = ($_SERVER ["REQUEST_METHOD"] == "POST") ? $_POST : null;
		$tutorId = TutorsListDB::getTutorIdFromUserId($user->getUserId());
		$courses = CoursesDB::getTutorCourses($tutorId);
		
	
	//	$user = new User( $inputForm );
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			/**$course = new Course($inputForm);
			
			print_r( $inputForm);**/
			
			$course = new Course($inputForm);
			
			$_SESSION['tutorCourse']= serialize($course);
			if ($course->getErrorCount() != 0 ){
				TutorEditView::show($courses);
			}else{
				
				unset($_SESSION['tutorCourse']);
				$name = $course->getCourseName();
				$courseArray = array();
				try{
				$courseArray = CoursesDB::getCoursesBy2('courseName',$name);
				}catch(PDOException $e){

				}
				if(empty($courseArray)){
					//echo $name;
					//print_r($courseArray);
					//echo'empty';
					try{
						$courseId = CoursesDB::addCourse($course);
					}catch (PDOException $e){
					
					}

					//add new course to DB
				}else{
					
					$courseArray = $courseArray[0];
					$courseId = $courseArray['courseId'];
					//print_r($courseArray);
					//echo'not empty';
					
					//grab the course ID
				}
			//	print_r($courseId);
				TutorsListDB::addTutorCourse($tutorId,$courseId);
				$courses = CoursesDB::getTutorCourses($tutorId);
				
				TutorEditView::show($courses);
				
				//add course to tutorcourses
				
				
				
				//header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'user');
			
				
					
			}
			
		}
		else{
			//	print_r($tutorId);
				
			//	print_r($courses);
			//$courses = CoursesDB::getTutorCourses();
			unset($_SESSION['tutorCourse']);
			TutorEditView::show($courses);
		}
		$_SESSION['tutorCourse']=serialize($course);
		
		
		
	/**	if (is_null($course) || $course->getErrorCount() != 0 ){
			//TutorEditView::show($courses);
		}else{
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'user');
			//header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base'].'/'.'user');
				
			unset($_SESSION['tutorCourse']);
			
		}**/
		
		
	//	UserView::show ($user);

	}
}

?>
 
