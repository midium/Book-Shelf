// JavaScript Document

	$('#publish-add-edit-form #submit').live("click",function() {
		// Fade in the progress bar
		$('#publish-add-edit-form #formProgress').hide();
		$('#publish-add-edit-form #formProgress').html('<img src="/assets/images/ajax-loader.gif" style="margin:10px;"/> Sending&hellip;');
		$('#publish-add-edit-form #formProgress').fadeIn();
		
		// Disable the submit button
		$('#publish-add-edit-form #submit').attr("disabled", "disabled");
		
		// Clear and hide any error messages
		//$('#publish-add-edit-form .formError').html('');
		
		// Set temaprary variables for the script
		var isFocus=0;
		var isError=0;
		
		// Get the data from the form
		var name=$('#publish-add-edit-form #publisher').val();
		var email=$('#publish-add-edit-form #pub-email').val();
		var web=$('#publish-add-edit-form #pub-web').val();
		var id=$('#publish-add-edit-form').attr('publisher_id');
		
		// Validate the data
		if(name=='') {
			$('#publish-add-edit-form #publisher').val('This is a required field.');
			$('#publish-add-edit-form #publisher').focus();
			$('#publish-add-edit-form #publisher').css("background","red");
			
			isFocus=1;
			isError=1;
		}
		if(email!='') {
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if(reg.test(email)==false) {
				$('#publish-add-edit-form #pub-email').val('Invalid email address.');
				$('#publish-add-edit-form #pub-email').focus();
				$('#publish-add-edit-form #pub-email').css("background","red");
				
				isError=1;
			}
		}
		
		// Terminate the script if an error is found
		if(isError==1) {
			$('#publish-add-edit-form #formProgress').html('');
			$('#publish-add-edit-form #formProgress').hide();
			
			// Activate the submit button
			$('#publish-add-edit-form #submit').attr("disabled", "");
			
			return false;
		}
		
		$.ajaxSetup ({
			cache: false
		});
		
		var dataString = '';
		var load_url = '';
		var error_alert = '';
					
		if($("div#publish-add-edit-form").attr("edit")=='true') { 
			load_url="publishers/edit_publisher";
			dataString = 'publisher='+ name + '&email=' + email + '&web=' + web + '&id=' + id;
			error_alert = 'There was an error editing the publisher. Please try again.';
			
		} else {
			load_url="publishers/add_publisher";
			dataString = 'publisher='+ name + '&email=' + email + '&web=' + web;
			error_alert = 'There was an error adding the publisher. Please try again.';
			
		}
		
		$.ajax({
			type: "POST",
			url: load_url,
			data: dataString,
			success: function(msg) {
				// Activate the submit button
				$('#publish-add-edit-form #submit').attr("disabled", "");				
				
				$('div#body-container').html(msg);
				//show_view('/main/publishers');
				
				return;
			},
			error: function(ob,errStr) {
				$('#publish-add-edit-form #formProgress').html('');
				alert(error_alert);
				
				// Activate the submit button
				$('#publish-add-edit-form #submit').attr("disabled", "");
				
				return;
			}
		});
		
		return false;
	});
	
  // Routines for the add new book button
  $('li#button.button').live("click", function() {
    // change the state of the element
	$("div#publish-add-edit-form").toggle(true);
	$("div#publishers-list").css({"top":"85px"});
	$("div#publish-add-edit-form").attr("edit","false");
	$("div#publish-add-edit-form").attr("publisher_id","");
	$('input#publisher').focus();
  });
  
  $('div#submit-close').live("click",function() {
	 	$("div#publish-add-edit-form").toggle(false);
		$("div#publishers-list").css({"top":"45px"});

		$('#publish-add-edit-form #publisher').val("");
		$('#publish-add-edit-form #pub-email').val("");
		$('#publish-add-edit-form #pub-web').val("");		
  });
  
  $('li#button.button').live("hover", function() {
    // change the state of the "#idd"
    $(this).css('cursor','pointer');
  });
  //-------------------------------------
  
  // Routines for the deletes buttons
  $('td#delete-pub').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/publish-minus-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#delete-pub').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/publish-minus.png\')');
  });
  
  $('td#delete-pub').live("click", function() {		
    //	call the removing routine
		
    	var dataString = 'pubid='+ $(this).attr("value");
		$.ajax({
			type: "POST",
			url: "publishers/delete_publisher",
			data: dataString,
			success: function(msg) {

				$('div#body-container').html(msg);
				//show_view('/main/publishers');

			},
			error: function(ob,errStr) {
				alert('There was an error deleting the publisher. Please try again.');
			}
		});
		
		return false;

  });
  
  //---------------------------------
  
  
   // Routines for the edit buttons
  $('td#edit-pub').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/publish-pencil-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#edit-pub').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/publish-pencil.png\')');
  });
  
  $('td#edit-pub').live("click", function() {		
    //	call the removing routine

		$("div#publish-add-edit-form").toggle(true);
		$("div#publishers-list").css({"top":"85px"});
		$("div#publish-add-edit-form").attr("edit","true");
		$("div#publish-add-edit-form").attr("publisher_id",$(this).attr("value"));
		
		$("input#publisher").val($(this).parent().find('#name').html());
		$("input#pub-email").val($(this).parent().find('#email').html());
		$("input#pub-web").val($(this).parent().find('#web').html());
		
		$('input#publisher').focus();
		
  });
  //---------------------------------
  
  
  // Routines for the books buttons
  $('td#books-pub').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#books-pub').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question.png\')');
  });
  
  $('td#books-pub').live("click", function() {		
    //	call the removing routine

	alert("Functionality not yet available!");
  });
  //---------------------------------