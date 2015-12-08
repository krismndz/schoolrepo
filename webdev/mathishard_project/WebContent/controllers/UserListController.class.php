<?php
class UserListController {
	// all controllers have a run method
	
	public static function run() {
		
		$_SESSION['headertitle'] = "Mathishard Users";
		$_SESSION['footertitle'] = "";
		
		$_SESSION['users'] = UsersDB::getUsersBy2();
		
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$arguments =  (array_key_exists('arguments', $_SESSION))?$_SESSION['arguments']:"";
		
		switch ($action) {
			
			case "show":
				$usersarray = UsersListDB::fetchUser('userId', $arguments);
				if(is_null($usersarray)||empty($usersarray) ){
					HomeView::show();
				}else{
				$user = new UserList($usersarray[0]);
				$_SESSION['userListId']=$arguments;
				$_SESSION['userList']=serialize($user);
				//echo $user;
				
					UserListView::show();
				}
				break;
				//self::show();
				//break;
			case "tutors":
				UserListView::show("tutors");
				break;
			case "submitrequest":
				UserListController::beginRequest();
				break;
			case "viewsentrequests":
				$_SESSION['studentRequests']= serialize(TutorRequestsDB::getAllStudentRequests($_SESSION['userId']));
				UserListView::viewRequestsSent();
				break;
			case "tutor-respond":
				$_SESSION['tutorRequestView']=serialize(TutorRequestsDB::getRequestsBy2('requestId',$_SESSION['arguments']));
				UserListView::viewTutorRequestResponse();
				break;
			default:
				UserListView::showall();
				break;
		}
		

		
		}
		public function beginRequest(){
			$tutorRequest=null;
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$_POST['studentId']=$_SESSION['userId'];
				$_POST['tutorId']=$_SESSION['userListId'];
				$tutorRequest=new TutorRequest($_POST);
			}
			$_SESSION['tutorRequest']=serialize($tutorRequest);
			if($tutorRequest==null||$tutorRequest->getErrorCount()!=0){
				UserListView::show();
				
			}else{
				
				TutorRequestsDB::addNewRequest($tutorRequest);
			
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/mk_project/userlist/viewsentrequests');
				echo "<br><br>POST ".$_POST."<br><br>";
			}
		}
	
		
	}

?>
 