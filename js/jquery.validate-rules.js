	$(document).ready(function() {
			
				jQuery.validator.addMethod("lettersonly", function(value, element) {
					return this.optional(element) || /^[a-z]+$/i.test(value);
					}, "Please enter only letters"); 
					
			// validate contact form on keyup and submit
			$("#login_form").validate({
			
			 errorElement: "span", 
			 
			 
			//set the rules for the fild names
			rules: {
			
				username: {
					required: true,
					minlength: 5,
					maxlength:25,
					lettersonly: true
				},
				password: {
					required: true,
					minlength: 5,
					maxlength:15
				},								
			},
			//set messages to appear inline
			messages: {
			
				username: {
					required: "Name is required..",
				},
				
				password: {
				required: "Please provide a password.",
				minlength: "Your password must be at least 5 characters",
				maxlength: "Password can not be more than 15 characters"
				},
								
			},
			
		errorPlacement: function(error, element) {               
					error.appendTo(element.parent());     
				}

		});
	});