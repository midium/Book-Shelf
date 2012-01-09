// JavaScript Document

	$('#add-edit-form #submit').live("click",function() {
		// Fade in the progress bar
		$('#add-edit-form #formProgress').hide();
		$('#add-edit-form #formProgress').html('<img src="/assets/images/ajax-loader.gif" /> Sending&hellip;');
		$('#add-edit-form #formProgress').fadeIn();
		
		// Disable the submit button
		$('#add-edit-form #submit').attr("disabled", "disabled");
		
		// Clear and hide any error messages
		//$('#add-edit-form .formError').html('');
		
		// Set temaprary variables for the script
		var isFocus=0;
		var isError=0;
		
		// Get the data from the form
		var name=$('#add-edit-form #authorname').val();
		var nationality=$('#add-edit-form #nationality').val();
		
		// Validate the data
		if(name=='') {
			$('#add-edit-form #authorname').val('This is a required field.');
			$('#add-edit-form #authorname').focus();
			$('#add-edit-form #authorname').css("background","red");
			
			isFocus=1;
			isError=1;
		}
		if(nationality=='') {
			$('#add-edit-form #nationality').val('This is a required field.');
			if(isFocus==0) {
				$('#add-edit-form #nationality').focus();
				$('#add-edit-form #nationality').css("background","red");
				isFocus=1;
			}
			isError=1;
		}
		
		// Terminate the script if an error is found
		if(isError==1) {
			$('#add-edit-form #formProgress').html('');
			$('#add-edit-form #formProgress').hide();
			
			// Activate the submit button
			$('#add-edit-form #submit').attr("disabled", "");
			
			return false;
		}
		
		$.ajaxSetup ({
			cache: false
		});
		
		var dataString = 'authorname='+ name + '&nationality=' + nationality;
		$.ajax({
			type: "POST",
			url: "authors/add_author",
			data: dataString,
			success: function(msg) {
				
				//$('#body-container').html(msg);

				// Activate the submit button
				$('#add-edit-form #submit').attr("disabled", "");				
				
				show_view('/main/authors');
				
				return;
			},
			error: function(ob,errStr) {
				$('#add-edit-form #formProgress').html('');
				alert('There was an error adding the author. Please try again.');
				
				// Activate the submit button
				$('#add-edit-form #submit').attr("disabled", "");
				
				return;
			}
		});
		
		return false;
	});