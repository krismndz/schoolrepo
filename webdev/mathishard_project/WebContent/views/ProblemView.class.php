<?php
class ProblemView {
	
	public static function show($problem){
	
		MasterView::showHeader("Problem Sucessfully Submitted",$problem);
		ProblemView::showDetails($problem);
		MasterView::showFooter("<div class=\"container\">
	<div class =\"site-footer\" role=\"contentinfo\"><footer>
  <p>&copy; 2015 FakeCompany, Inc.
 Contact information: <a href=\"mailto:someone@example.com\">someone@example.com</a>.</p>
</footer>
</div>
</div>
		
</body>
</html>");
	}
  public static function showDetails() {  
		
?>
	<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Problem Sucessfully Submitted</title>
</head>
<body>
<header>
<div class ="header header-logged-out" role = banner>
<nav>
<div class= "container-clearfix">
<img src="mathishard.jpeg" alt="Math Is Hard" >
<div class="header-actions" role="navigation">
  <a class = "btn btn-primary" href="index" data-ga-click="(Logged Out) Header, clicked Home, text:sign-up">Home</a> |

  
</div>
</div>
</nav>
</div>
</header>
<section>

<h1>Thanks for your problem!</h1>

<aside>
<h4>A tutor will recive your problem and get back to you soon.</h4>
</aside>


</section>
<div class="container">
<div class ="site-footer" role="contentinfo"><footer>
  <p>&copy; 2015 FakeCompany, Inc.
 Contact information: <a href="mailto:someone@example.com">someone@example.com</a>.</p>
</footer>
</div>
</div>

</body>
</html>
<?php
  }
}
?>