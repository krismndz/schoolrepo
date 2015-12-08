<?php  
class LoginView {
	
	public static function show(){
		$_SESSION['headertitle'] = "Mathishard Log In Page";
		$_SESSION['styles'] = array('login.css');
	//$_SESSION['jscript']=array('post.js');
		MasterView::showHeader();
		MasterView::showNavbar();
		//LoginView::showDetails();
		LoginView::showTest();
		MasterView::showFooter();
		MasterView::showPageEnd();
		
	}
	public static function showTest(){
		$loginuser = (array_key_exists('loginuser', $_SESSION))?unserialize($_SESSION['loginuser']):null;
		$base = (array_key_exists('base', $_SESSION))?$_SESSION['base']:"mk_project";
		
		echo'<div class = "container">
	
	<div class="wrapper">
	<div class = "row">
		<form action="/'.$base.'/login" method="post" name="/'.$base.'/login" class="form-signin">       
		    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
			  <hr class="colorgraph"><br>';
		
		
		echo'<div class = "row">';
		echo'<div class = "form-group">';
		echo' <input type="text" class="form-control" id="userName" name="userName" placeholder="Username" required="" autofocus="" value="';
			if (!is_null($loginuser)){
				echo  $loginuser->getUserName();
			}
			  echo'" tabindex = "1">';
			  if(!is_null($loginuser)){
			  	self::sendError($loginuser,'userName');
			  }
			
			  echo'</div>';
			//  echo'<span id="userNameError" class="error"></span>';
			  echo'</div>';
			  
			  echo'<div class = "row">';
			  echo'<div class = "form-group">';
			  echo'
			  <input type="password" class="form-control" name="pass" placeholder="Password" required="" value="';
			  if (!is_null($loginuser))
			  	echo  $loginuser->getUserPass();
			  	
			  
			  echo'" tabindex="2">    ';
			  if(!is_null($loginuser)){
			  self::sendError($loginuser,'pass');
			  }
			  echo'</div>';
			  echo'</div>';
			  
			/**  echo '<script>';
			  echo'$(document).ready(function(){';
			   echo'$("#userName").blur(function(){';
			     echo' $.ajax({type: "POST",';
			      	   echo' url:"/mk_project/controllers/jsonPostController.php",';
			      	   echo'data: $(this).serialize(),';
			      	   echo' dataType: \'json\',';
			      	   echo' success: function(result){$("#userNameError").html(JSON.stringify(result));},';
			              echo'error: function() {';
			              	echo'alert (\'Failed to download JSON string\');';
			             echo' }';
			            echo' });';
			    echo'});';
			  echo'});';
			  echo '</script>';	**/
			  echo' 		  
			 <div class = "row">
			  		<div class="col-sm-12">
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="login" type="Submit">Login</button>  			
		</div></div>
			</form>	  		
		</div>	  				
	</div>
</div>';

/**echo '<script>';
echo'$(document).ready(function(){';
 echo'$("#userName").blur(function(){';
   echo' $.ajax({type: "POST",';
    	   echo' url:"/mk_project/controllers/jsonPostController.php",';
    	   echo'data: $(this).serialize(),';
    	   echo' dataType: \'json\',';
    	   echo' success: function(result){$("#userNameError").html(JSON.stringify(result));},';
            echo'error: function() {';
            	echo'alert (\'Failed to download JSON string\');';
           echo' }';
          echo' });';
  echo'});';
echo'});';
echo '</script>';	**/
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
