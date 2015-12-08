/**
 * 
 */

$(document).ready(function(){
  $("#userName").blur(function(){
    $.ajax({type: "POST",
    	    url:"/jstest/controllers/jsonPostController.php",
    	    data: $(this).serialize(),
    	    dataType: 'json',
    	    success: function(result){$("#userNameError").html(JSON.stringify(result));},
            error: function() {
            	alert ('Failed to download JSON string');
            }
           });
  });
});