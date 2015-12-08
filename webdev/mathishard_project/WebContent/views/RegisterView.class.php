<?php
class RegisterView {
	public static function show($form){
		
		$_SESSION['headertitle']="Mathishard Registration Page";
		$_SESSION['footertitle'] ="";
		$_SESSION['styles'] = array('login.css');
		$_SESSION['jscript']=array('event-attributes.js');
		MasterView::showHeader();
		MasterView::showNavbar();
		//RegisterView::showDetails();
		switch($form){
			case "form1":
				self::showFormOne();
				break;
			case "form2":
				self::showFormTwo();
				break;
			default:
				break;
		}
		//RegisterView::showTest();

		MasterView::showPageEnd();
		MasterView::showFooter();
	}
	public static function showFormOne(){
		
		
		$user = (array_key_exists('reguser', $_SESSION))?unserialize($_SESSION['reguser']):null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"mk_project";
		
		
		
		
		echo'<div class="container">
	<div class = "wrapper">
	<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	<form role="form" method="post" action="/'.$base.'/register/form1">';
				
			echo'<h2>Welcome to Step by Step <small>Sign up</small></h2>
			
			<hr class="colorgraph">
			<div class="row">
					
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="firstName" id="firstName" class="form-control input-lg" placeholder="First Name"';
                        

			if (!is_null($user))
			{
				echo 'value = "'. $user->getFirstName() .'"';
			}
			echo ' tabindex="1" onblur="checkFirstName()">';
			echo'<div id="feedbackFirstName"></div>';
			
			self::sendError($user,'firstName');
	


             echo'
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="lastName" id="lastName" class="form-control input-lg" placeholder="Last Name"';
						

             if (!is_null($user))
             {
             	echo 'value = "'. $user->getLastName() .'"';
             }
             echo 'tabindex="2" onblur="checkLastName()">';
             self::sendError($user,'lastName');
			echo'<div id="feedbackLastName"></div>';
				echo' </div>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="userName" id="userName" class="form-control input-lg" placeholder="User Name"';
				
				if (!is_null($user))
				{
					echo 'value = "'. $user->getUserName() .'"';
				}
				echo' tabindex="3" onblur="checkUserName()">';
				self::sendError($user,'userName');
				echo'<div id="feedbackUserName"></div>';
				echo'</div>';
				//--------------------------------------------
				echo' 
			
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" ';
				
				if (!is_null($user))
				{
					echo 'value = "'. $user->getEmail() .'"';
				}
				echo' tabindex="4" onblur="checkEmail()">';
				
				self::sendError($user,'email');
				echo'<div id="feedbackEmail"></div>';
				echo'</div>';
				//--------------------------------------------
				echo'
			
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="pass" id="pass" class="form-control input-lg" placeholder="Password"';
				if (!is_null($user))
				{
					echo 'value = "'. $user->getPassword() .'"';
				}		
				echo' tabindex="5" onblur="checkPasswordMatch()">';
				echo'<div id = "feedbackPasswordMatch"></div>';
				self::sendError($user,'pass');
						
			echo'</div>
				</div>';
				
			//--------------------------------------------
				
				echo'
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="pconf" id="pconf" class="form-control input-lg" placeholder="Confirm Password" ';
			if (!is_null($user))
			{
				echo 'value = "'. $user->getPasswordConf() .'"';
			}		
			echo'tabindex="6" onblur="checkPasswordMatch()">';
			echo'<div id = "feedbackPasswordMatch"></div>';
			self::sendError($user,'pconf');
						
						echo'
					</div>
				</div>
			</div>
		
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Register" class="btn btn-success btn-block btn-lg" tabindex="7"></div>
				<div class="col-xs-12 col-md-6"><a href="/'.$base.'/login" class="btn btn-primary btn-block btn-lg">Sign In</a></div>
			</div>
		</form>
	</div>
						</div>
</div>';
	}
	
	
	
	
	public static function showFormTwo(){

				
		$user = (array_key_exists('reguser2', $_SESSION))?unserialize($_SESSION['reguser2']):null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"mk_project";
		
		
		
		
		echo'<div class="container">
	<div class = "wrapper">
	<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	<form role="form" method="post" action="/'.$base.'/register/form2">';
				
			echo'<h2>Step Two:<br> <small>We want to get to know you</small></h2>
			
			<hr class="colorgraph">';
			//--------------------------------------------------
			
			echo'<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">';
					echo'<h4>What brings you here?</h4>';
					echo'<div class="dropdown">';
						echo'<select name="userRole" value="userRole" class="form-control input-lg" onblur="checkRole()">';
			echo'<option value=""></option>';
			echo'<option ';
		   if (!is_null($user)) {echo $user->getUserRole()=='Tutor'?'selected':'';}
		   echo' value = "Tutor" >Tutor</option>';
		   echo'<option ';
		   if (!is_null($user)) {echo $user->getUserRole()=='Student'?'selected':'';}
		   echo'  value = "Student" >Student</option>';
		   
						echo'
                    </select>';
						self::sendError($user,'userRole');
						echo'<div id = "feedbackRole"></div>';
						
						echo'</div>';
						echo'
					</div></div>';
						
//--------------------------------------------------------------------
echo'<div class="col-xs-12 col-sm-6 col-md-6">
<div class="form-group">
<h4>Your student status: </h4>';
						
echo'<div class="dropdown">';
echo'<select name="status" value="Select one" class="form-control input-lg" onblur="checkStatus()">';
echo'<option value=""></option>';
						
						echo'<option value="Undergraduate"';
		   if (!is_null($user)) {echo $user->getStatus()=='Undergraduate'?'selected':'';}
		   echo' >Undergraduate</option>';
			 echo'<option value="Graduate"';
		   if (!is_null($user)) {echo $user->getStatus()=='Graduate'?'selected':'';}
		   echo' >Graduate</option>';
						echo'</select>';
						self::sendError($user,'status');
						echo'<div id = "feedbackStatus"></div>';
						
						echo'</div>';
						echo'</div></div>';
						


//--------------------------------------------------------------------
						echo'
									<div class="form-group">
								<h4>How confident are you in your mathematics courses?</h4>';
						
						echo'<div class="dropdown">';
						echo'<select name="skill_level" id="skill_level" value="Select one" class="form-control input-lg" onblur="checkLevel()">';
						echo'<option value=""></option>';
						
						
						echo'<option  value="Very unconfident"';
						if (!is_null($user)) {echo $user->getSkillLevel()=='Very unconfident'?'selected':'';}
						echo'>Very unconfident</option>';
						echo'<option value="Somewhat unconfident"';
						if (!is_null($user)) {echo $user->getSkillLevel()=='Somewhat unconfident'?'selected':'';}
						echo'>Somewhat unconfident</option>';
						echo'<option value="It varies"';
						if (!is_null($user)) {echo $user->getSkillLevel()=='It varies'?'selected':'';}
						echo'>It varies</option>';
						echo'<option value="Somewhat confident"';
						if (!is_null($user)) {echo $user->getSkillLevel()=='Somewhat confident'?'selected':'';}
						echo'>Somewhat confident</option>';
						echo'<option value="Very confident"';
						if (!is_null($user)) {echo $user->getSkillLevel()=='Very confident'?'selected':'';}
						echo'>Very confident</option>';
						echo'
                    </select>';
						self::sendError($user,'skill_level');
						echo'<div id = "feedbackLevel"></div>';
						echo'</div>';
						echo'
						
						
					</div>';
						
		
//------------------------------------------------------------------
				echo'<div class="row">
						
						
						<div class="col-xs-12 col-sm-6 col-md-6">
					
					<div class="form-group">
						  <label>Gender   </label> 
					<div class="radio-inline">
				
				
                        <input type="radio" name="gender" id="gender" value="female" ';
                        

			if (!is_null($user) && $user->getGender()=="female")
			{
				echo 'checked';
			}
				echo '>Female';
			echo'</div>';
			
	
	


             echo'
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
             		<div class="radio-inline">
						<input type="radio" name="gender" id="gender" value="male" ';
						

             if (!is_null($user) && $user->getGender()=="male")
             {
             	echo 'checked';
             }
             echo '>Male';

             self::sendError($user,'gender');
             echo'</div>';
          
						
				echo' </div>
				</div>
			</div>';
			
				//---------------------------
				
			echo'
			
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						
						
						<h4>Birthday</h4><input type="date" name="bday" id="bday" class="form-control input-lg"';
				if (!is_null($user))
				{
					echo 'value = "'. $user->getBday2() .'"';
				}		
				echo' tabindex="5">';
				self::sendError($user,'bday');
				echo'</div>';
				echo'</div>';
				
				//---------------------------
				
			echo'
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
					
					Phone Number<input type="tel" name ="tele" class="form-control input-lg" placeholder="Phone number" ';
	
		
		if (!is_null($user)) 
		{
			echo 'value = "'. $user->getPnum() .'"';
		}
		echo'tabindex="6" onblur="checkPhoneNumber()"> ';
		self::sendError($user,'tele');
		echo'<div id="feedbackPhoneNumber"></div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';

		//---------------------------
						
						echo'
					
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Register" class="btn btn-success btn-block btn-lg" tabindex="7"></div>
				<div class="col-xs-12 col-md-6"><a href="/'.$base.'/login" class="btn btn-primary btn-block btn-lg">Sign In</a></div>
			</div>
		</form>
	</div>
						</div>
</div></div>';
        
       
	}
	
	
	
	
	public static function sendError($user, $name){
		if (!is_null($user) && !empty($user->getError($name))) {
			echo'<div class="alert alert-danger" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo'<strong>Error: </strong>';
			echo $user->getError($name);
			echo '</div>';
		}
	}
}
?>



