

$('.open-popup-link').magnificPopup({
	
	items : {
		src:$('<div class = "mfp-content">'+
				'<form role = "form" id="test-popup" method ="post" class="white-popup-block" action="/mk_project/userlist/submitrequest">'+'<h1>Tutor Request Form</h1>'+
				'<fieldset style="border:0;">'+
				'<p>Please fill in all required feilds in order to submit your request.</p>'+
				'<ol>'+
					'<li>'+
						'<label for="contact">Best way to contact me:</label>'+
						'<select id ="contact" name="contact" onblur="checkContact()">'+
						'<option value= ""></option>'+
						'<option value="Phone">Phone</option>'+
						'<option value="E-mail">E-mail</option>'+
						'<option value="Both">Both</option>'+
						'</select>'+
						'<div id="feedbackContact"></div>'+
					'</li>'+
					'<li>'+
						'<label for="courseChosen">Course</label>'+
						
						'<input id="courseChosen" name="courseChosen" type="text" placeholder="example: Math 3333" onblur="checkCourseChosen()" required>'+
						'<div id="feedbackCourseChosen"></div>'+
						'</li>'+
				
					'<li>'+
						'<label for="textarea">Best times to contact:</label><br>'+
						'<textarea id="studentMessage" name="studentMessage" onblur="checkMessage()"></textarea>'+
						'<div id="feedbackMessage"></div>'+
						'</li>'+
				'</ol></fieldset>'+
				'<div class="row">'+
				'<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Submit Request" class="btn btn-success btn-lg"></div></div>'+
			'</form></div>'),
		type:'inline',
		preloader: false,
		focus: '#name',
		
	},
	// When elemened is focused, some mobile browsers in some cases zoom in</span>
	// It looks not nice, so we disable it:</span>
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		},
		
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

});


$('.tutor-respond-link').magnificPopup({
	
	items : {
		src:$(
				'<div class = "mfp-content">'+
				'<form role = "form" id="tutor-respond" method ="post" class="white-popup-block" action="/mk_project/user/respondrequest/'+
				
				'">'+'<h1>Tutor Respond Form</h1>'+
				'<fieldset style="border:0;">'+
				'<p>Please fill in all required feilds in order to submit your request.</p>'+
				'<ol>'+
					'<li>'+
						'<label for="RequestAccept">Accept/Decline Request</label>'+
						'<select id="requestAccept" name="requestAccept" value="requestAccept" class="form-control" onblur="checkRequest()">'+
					'<option value="" selected></option>'+
					'<option value="Accept">Accept</option>'+
					'<option value="Decline">Decline</option>'+
					'<div id="feedbackRequestAccept"></div>'+
					'</select>'+
					
						'</li>'+
					'<li>'+
						'<label for="timeSuggestT">Suggest a date and time</label>'+
						'<input id="timeSuggestT" name="timeSuggestT" type="datetime-local" required>'+
						
						'</li>'+
					'<li>'+
						'<label for="phone">Phone number(optional) </label>'+
						'<input id="phone" name="phone" type="tel" placeholder="Eg. +447500000000" >'+
					'</li>'+
					'<li>'+
						'<label for="textarea">Message (optional)</label><br>'+
						'<textarea id="textarea" name="message"></textarea>'+
					'</li>'+
				'</ol></fieldset>'+
				'<div class="row">'+
				'<div class="col-xs-12 col-md-6"><input type="submit" name="submitHTML5" value="Submit Request" class="btn btn-success btn-lg"></div></div>'+
			'</form></div>'),
		type:'inline',
		preloader: false,
		focus: '#name',
		
	},
	// When elemened is focused, some mobile browsers in some cases zoom in</span>
	// It looks not nice, so we disable it:</span>
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		},
		
  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

});


$(document).ready(function() {
	$('.popup-with-form').magnificPopup({
		type:'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in</span>
	// It looks not nice, so we disable it:</span>
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});
});