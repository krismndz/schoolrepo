<?php
class UserController {
	// all controllers have a run method
	
	public static function run() {
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$arguments =  (array_key_exists('arguments', $_SESSION))?$_SESSION['arguments']:"";
		switch ($action) {
			case "new":
				self::newUser();
				break;
			case "show":
				$usersarray = UsersDB::fetchUser('userId', $arguments);
	
				$user = new User ($usersarray[0]);
				$_SESSION['userId']=$arguments;
				$_SESSION['user']=serialize($user);
				UserView::show($user);
				break;
				//self::show();
				//break;
			case  "showall":
				$_SESSION['users'] = UsersDB::getUsersBy2();
				$_SESSION['headertitle'] = "Mathishard Users";
				$_SESSION['footertitle'] = "";
				UserView::showall();
				break;
			case "requests":
				$_SESSION['requests']=TutorRequestsDB::getAllRequests($_SESSION['userId']);
				UserView::showRequests();
				break;
			case "tutor-respond":
				$_SESSION['submitRequestId']=$_SESSION['arguments'];
				UserView::showTutorReply();
				break;
			case "respondrequest":
				UserController::respondRequest();
				break;
			case "responseSent":
				UserView::tutorResponseSent();
				break;
			default:
				self::show();
				break;
		}
		
		/**$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		if (is_null($user)){
			
		}
		UserView::show ();
		**/
		}
		public static function respondRequest(){
			$tutorResponse=null;
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$tutorResponse=new TutorResponse($_POST);
			}
			$_SESSION['tutorResponse']=serialize($tutorResponse);
			if(is_null($tutorResponse)||$tutorResponse->getErrorCount()!=0){
				UserView::showTutorReply();
			}else{
				
				$tutorRequest = TutorRequestsDB::getRequestsBy2('requestId',$_SESSION['submitRequestId']);
				$requestId=$_SESSION['submitRequestId'];
				TutorRequestsDB::updateTutorRequest('acceptRequest',$tutorResponse->getAcceptRequest(),$requestId);
				TutorRequestsDB::updateTutorRequest('tutorMessage',$tutorResponse->getTutorMessage(),$requestId);
				TutorRequestsDB::updateTutorRequest('tutorResponded','1',$requestId);
				
				TutorRequestsDB::updateTutorRequest('tutorPhone',$tutorResponse->getPhoneBool(),$requestId);
				TutorRequestsDB::updateTutorRequest('tutorEmail',$tutorResponse->getEmailBool(),$requestId);

				header('Location: http://'.$_SERVER["HTTP_HOST"].'/mk_project/user/requests');
			
			}
			
			
		}
		public static function show() {
		
			$user =(array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
		
			if (!is_null($user)) {
		
				UserView::show();
			} else
				HomeView::show();
		}
		
	}

?>
 