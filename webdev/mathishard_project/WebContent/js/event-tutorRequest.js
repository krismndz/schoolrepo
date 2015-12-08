/**
 * 
 */

function openRequest(){
	var elMsg = document.getElementById('feedbackUserName');
	var elUsername = document.getElementById('userName');
	if(elUsername.value.length<4){
		
		//elMsg.textContent='<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error: </strong>Username must be 4 character or more</div>';
		elMsg.textContent='Username must be 4 characters or more';
	}else{
		elMsg.textContent='';
	
	}
}
