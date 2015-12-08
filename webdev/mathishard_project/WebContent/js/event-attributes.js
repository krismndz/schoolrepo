/**
 * 
 */
requestid="";
function checkUserName(){
	var elMsg = document.getElementById('feedbackUserName');
	var elUsername = document.getElementById('userName');
	if(elUsername.value.length<4){
		
		//elMsg.textContent='<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error: </strong>Username must be 4 character or more</div>';
		elMsg.textContent='Username must be 4 characters or more';
	}else{
		elMsg.textContent='';
	
	}
}
function checkFirstName(){
	var elMsg = document.getElementById('feedbackFirstName');
	var elUsername = document.getElementById('firstName');
	if(elUsername.value.length<2){
		elMsg.textContent='First name must be 2 characters or more';
	}else{
		elMsg.textContent='';
	
	}
}
function checkPasswordMatch(){
	var elMsg = document.getElementById('feedbackPasswordMatch');
	var elPassword = document.getElementById('pass');
	var elPasswordConf= document.getElementById('pconf');
	if( elPassword.value.length!=0 && elPasswordConf.value.length!=0  ){
		if(!(elPassword.value==elPasswordConf.value)){
			elMsg.textContent='Passwords do not match';
		}else{
			elMsg.textContent='';
		}
		
	}else{
		elMsg.textContent='';
	
	}
}
function checkLastName(){
	var elMsg = document.getElementById('feedbackLastName');
	var elUsername = document.getElementById('lastName');
	if(elUsername.value.length<3){
		elMsg.textContent='Last name must be 3 characters or more';
	}else{
		elMsg.textContent='';
	
	}
}
function checkRequest(){
	var elMsg = document.getElementById('feedbackRequestAccept');
	var elUsername = document.getElementById('requestAccept');
	if(elUsername.value.length==0){
		elMsg.textContent='You must enter a decision';
	}else{
		elMsg.textContent='';
	
	}
}
function checkMessage(){
	var elMsg = document.getElementById('feedbackMessage');
	var elUsername = document.getElementById('studentMessage');
	if(elUsername.value.length==0){
		elMsg.textContent='Please enter the best times to contact';
	}else{
		elMsg.textContent='';
	
	}
}
function checkContact(){
	var elMsg = document.getElementById('feedbackContact');
	var elUsername = document.getElementById('contact');
	if(elUsername.value.length==0){
		elMsg.textContent='You must specify a contact';
	}else{
		elMsg.textContent='';
	
	}
}
function setRequestId(element){
	var id = element.id;
	alert(element.id);
}
function myAjax () {
	$.ajax( { type : 'POST',
	          data : { },
	          url  : 'bb2.php',              // <=== CALL THE PHP FUNCTION HERE.
	          success: function ( data ) {
	            alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
	          },
	          error: function ( xhr ) {
	            alert( "error" );
	          }
	        });
	}
function getRequestId(){
	return requestid;
}
function checkEmail(){
	var elMsg = document.getElementById('feedbackEmail');
	var elUsername = document.getElementById('email');
	if(elUsername.value.length==0){
		elMsg.textContent='Please enter your e-mail';
	}else{
		elMsg.textContent='';
	
	}
}
function checkRole(){
	var elMsg = document.getElementById('feedbackRole');
	var elUsername = document.getElementById('userRole');
	if(elUsername.value==""){
		elMsg.textContent='Please specify a user role';
	}else{
		elMsg.textContent='';
	
	}
}
function checkStatus(){
	var elMsg = document.getElementById('feedbackStatus');
	var elUsername = document.getElementById('status');
	if(elUsername.value==""){
		elMsg.textContent='Please specify your student status';
	}else{
		elMsg.textContent='';
	
	}
}

function checkLevel(){
	var elMsg = document.getElementById('feedbackLevel');
	var elUsername = document.getElementById('skill_level');
	if(elUsername.value==""){
		elMsg.textContent='Please specify your skill level';
	}else{
		elMsg.textContent='';
	
	}
}
function checkPhoneNumber(){
	var elMsg = document.getElementById('feedbackPhoneNumber');
	var elUsername = document.getElementById('tele');
	if(elUsername.value.length==0){
		elMsg.textContent='Please specify your phone number';
	}else{
		elMsg.textContent='';
	
	}
}
function checkGender(){
	
}
function checkCourseChosen(){
	var elMsg = document.getElementById('feedbackCourseChosen');
	var elUsername = document.getElementById('courseChosen');
	if(elUsername.value.length<7){
		elMsg.textContent='You must enter a valid course name';
	}else{
		elMsg.textContent='';
	
	}
}