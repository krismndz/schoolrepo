<?php
class MasterView {


	
	public static function showHeader() {
		//for testing
		//MasterView::printSessionVars();
		

		$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
		echo '<!DOCTYPE html lang="en"><html><head>';
		echo '<meta charset="utf-8">';
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		MasterView::printScriptSrc();
		MasterView::printStyleSheets();
		MasterView::printCssSheets();
		//this::printJScripts();
		//echo'<meta name="keywords" content="JQuery"/>';
		//echo'<meta name="description" content="JQuery, qunit"/>';
		
		$title = (array_key_exists('headertitle', $_SESSION))?$_SESSION['headertitle']: "";
		echo "<title>$title</title>";
		if($_SESSION['action']=="requests"){
			echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type = "text/javascript">
function myAjax () {
$.ajax( { type : \'POST\',
          data : { },
          url  : \'/mk_project/js/bb2.php\',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
            alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
}
    </script>';
		}
		
		echo "</head><body class>";
		echo'<script src="http://dimsemenov.com/plugins/magnific-popup/third-party-libs/zepto.min.js"></script>';
		echo'<script src = "/mk_project/jquery.magnific-popup.min.js"></script>';
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
		
		
	}
 	
    public static function printScriptSrc(){
    	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
   	 	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>';
        echo '<script src="/mvcjs/js/jquery-ui-timepicker-addon.js"></script>';
        echo '<script src="/mvcjs/js/assign.js"></script>';
    
    }
    
	public static function printStyleSheets(){
		$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
    	  echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';
          echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">';
          echo '<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">';
          echo '<link rel="stylesheet" href="/'.$base.'/css/jquery-ui-timepicker-addon.css">';
      		echo '<link href="/'.$base.'/css/navbar-static-top.css" rel="stylesheet">';
     }
     
	public static function printCssSheets(){
		$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
		$styles = (array_key_exists('styles', $_SESSION))? $_SESSION['styles']: array();
	
		
		foreach ($styles as $style )
			echo '<link href="/'.$base.'/css/'.$style. '" rel="stylesheet">';
	}
     public static function printJScripts(){
    	 $base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
    	 $jscript = (array_key_exists('jscript', $_SESSION))? $_SESSION['jscript']: array();
 		if(!empty($jscript)){
 			foreach ($jscript as $js )
 				echo '<script src="/../js/'.$js.'"></script>';
 		}
     }
    public static function showNavBar() {
    	
    	$base =(array_key_exists('base', $_SESSION))? $_SESSION['base']: "";
    	$user = (array_key_exists('user', $_SESSION))?unserialize($_SESSION['user']):null;
    	//$user = $users[0];
    	//print_r( $user);
    	$control = (array_key_exists('control', $_SESSION))?$_SESSION['control']:null;
	echo '<nav class = "navbar fixed-nav-bar navbar-default navbar-static-top">
	<div class = "container">
		
					<div class = "navbar-header">
						
						<button type = "button" class = "navbar-toggle collapsed" data-toggle="collapse" data-target=
						"#navbar" aria-expanded="false" aria-controls="navbar">
							<span class = "sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/'.$base.'/home">Mathishard</a>
			
						</div>
						<div id="navbar" class="navbar-collapse collapse"
						aria-expanded="false" style="height: 1px;">
						<ul class ="nav navbar-nav">
							<li class="active">
								<a href="/'.$base.'/home">Home</a>
							</li>
							<li>
								<a href="#about">About</a>
							</li>
							<li>
								<a href="#contact">Contact</a>
							</li>
							
			</ul>';
	
	
					echo '<!--<ul class="nav navbar-nav navbar-right">';
					
					
					
					
					
	echo'
				<li>

				<a href="../navbar/">Default</a>
				</li>			
				<li class ="active">
					<a href="./">Static top
					<span class="sr-only">(current)</span>
					</a>
				</li>
				<li>
					<a href="../navbar-fixed-top/">Fixed top</a>
				</li>
				</ul>-->
			
			
			';
			echo'<ul class="nav navbar-nav navbar-right">
					
					';
			if(!is_null($user)){
				echo '<li><div class="form-group">';
				echo '<h4><span class="label label-success">Hi '.
						$user->getUserName().'</span>&nbsp; &nbsp;</h4>';
				echo '</div></li>';
					
			}
		
			echo'<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle
				="dropdown" role="button" aria-haspopup="true"
				aria-expanded="false">
				Find
				<span class="caret"></span>
				</a><ul class="dropdown-menu">';
			
			if(!is_null($user)){
				echo'
							
			<li>
				<a href="/'.$base;
								if(!is_null($user)){
									echo '/user">Your Profile';
								}else{
									echo'#">Action 1';
								}
								echo'</a>
		</li>
		<li>
			<a href="/'.$base;
			if(!is_null($user)){
				if($user->getUserRole()=="Student"){
					echo '/tutorfinder">Find Tutor';
				}elseif($user->getUserRole()=="Tutor"){
					echo '/tutoredit">Your Tutor Subjects';
				}
			}else{
				echo'#">Action 2';
			}
							
				echo'</a>';
			
			}
			echo'
				</li>';
				
			if(!is_null($user)){
				
				if($user->getUserRole()=="Tutor"){
					echo'<li><a href="/mk_project/user/requests">View Tutor Requests</a></li>';
				}
				elseif($user->getUserRole()=="Student"){
					echo'<li><a href="/mk_project/userlist/viewsentrequests">View Tutor Requests</a></li>';
				}
			
			}
				echo'
			
				<li role ="separator" class="divider"></li>
				<li class="dropdown-header"><!--Nav header---></li>';
				
				if(!is_null($user)){
					echo'<li>';
							
					if($user->getUserRole()=="Tutor"){
						echo'<a href="/'.$base.'/userlist">View all users</a>';
					}elseif($user->getUserRole()=="Student"){
						echo'<a href="/'.$base.'/userlist">View all tutors</a>';
					}
				echo'
					</li>';
				
				}
				echo'<li>
					<a href="/'.$base.'/tests.html">Tests</a>
				</li>
							
			<li role ="separator" class="divider">serp</li>
			';
			if(!is_null($user)){
				echo'<li><a href="/'.$base.'/logout">Logout</a></li>';
			}
			echo'
				</ul>
				</li>';
					if(!is_null($user)){
						echo '<form class="navbar-form navbar-right"
    			    method="post" action="/'.$base.'/logout">';
						
						/**echo '<div class="form-group">';
						echo '<h4><span class="label label-success">Hi '.
								$user->getUserName().'</span>&nbsp; &nbsp;</h4>';
						echo '</div>';**/
						/**echo '<button type="submit" class="btn btn-primary btn-sml">Logout</button>';**/
						echo '</form>';
					}else{
					echo '<form class="navbar-form navbar-right"
	    			    method="get" action="/'.$base.'/login">';
					/**	echo '<div class="form-group">';
						echo '<input type="text" placeholder="User name" class="form-control" name ="userName" ';
						if (!is_null($user))
							echo 'value = "'. $user->getUserName();
						echo 'required></div>';
						echo '<div class="form-group">';
						echo '<input type="password" placeholder="Password"
	    			      class="form-control" name ="pass">';
						echo '</div>';
						echo '<button type="submit" class="btn btn-primary-minimal">Login</button>';
						**/
					//	echo '<a class="btn btn-minimal" href="/'.$base.'/login" role = "button">Login</a>';
						echo '<button type="submit" class="btn btn-primary-minimal">Login</button>';
						echo '<a class="btn btn-success" href="/'.$base.'/register/form1" role = "button">Sign Up</a></p>';
						echo '</form>';
						
	echo'	
			</ul>
			
		
			';
					
					}						
							
							echo'
							</div>
							</div>
					</nav>
							
				';

	
    
  	}
  	
    public static function printSessionVars(){
    	echo'<br><br><br><br>';
    	foreach($_SESSION as $key => $val){
    			if(gettype($val)=="Array"){
    				foreach($val as $key2 => $val2){
    						print_r($key2."->".$val2."<br>");
    				}
    			}else{
    				print_r($key."->".$val."<br>");
    			}
    			
    		}
		print_r('<br>Request:'.$_SERVER['REQUEST_METHOD'].'<br>');
    }
    public static function showFooter() {
    	$footer = (array_key_exists('footertitle', $_SESSION))?
    	$_SESSION['footertitle']: "";
    	if (!is_null($footer))
    		//echo '<div class = "containter">'.$footer.'</div>';

	echo'	<hr style="width:85%; color: black; height: .5px;background-color:grey;" align="center" >
	
			<div class="container">
			<hr style="width:100%; color: white; height: .5px;background-color:grey;" align="center" >
			<div class ="site-footer" role="contentinfo" >
					<a class="site-footer-links  ">
						
							&copy; 2015  Kristin Mendoza, UTSA 
						
					</a>
					
					<p class="pull-right">
							<a href="mailto:someone@example.com" data-go-click="Gooter, go to contact, text:
							contact">Contact</a></p>';
		
    	$control = (array_key_exists('control', $_SESSION))? $_SESSION['control']: "";
		if($control=="home"||$control==""||$control=="logout"){
			echo'<br>'. $footer;
		}
    
					echo'	
			
			
					
			
					
					
					
		
			</div>
		</div>';
	

    
    }
    public static function showPageEnd(){
    	$jscript = (array_key_exists('jscript', $_SESSION))? $_SESSION['jscript']: array();
    	if(!empty($jscript)){
    		foreach ($jscript as $js )
    			echo '<script type="text/javascript" src="/mk_project/js/'.$js.'"></script>';
    	}
    	$base = (array_key_exists('base', $_SESSION))? $_SESSION['base']: "mk_project";
    	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
    	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
    	echo '<script src="../../dist/js/bootstrap.min.js"></script>';
    	echo '<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>';
    	
    	
    	//echo'<script type="text/javascript" src="script.js"></script>';
    	
    	echo'</body></html>';
    }
  
    
    
    

    
    

    
    
    	
    	
  }
  ?>
