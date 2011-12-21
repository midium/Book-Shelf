// JavaScript Document

	$('#add-edit-form #submit').live("click",function() {
		// Fade in the progress bar
		$('#add-edit-form #formProgress').hide();
		$('#add-edit-form #formProgress').html('<img src="/assets/images/ajax-loader.gif" style="margin:10px;"/> Sending&hellip;');
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
		var id=$('#add-edit-form').attr('author_id');
		
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
		
		var dataString = '';
		var load_url = '';
		var error_alert = '';
					
		if($("div#add-edit-form").attr("edit")=='true') { 
			load_url="authors/edit_author";
			dataString = 'authorname='+ name + '&nationality=' + nationality + '&id=' + id;
			error_alert = 'There was an error editing the author. Please try again.';
			
		} else {
			load_url="authors/add_author";
			dataString = 'authorname='+ name + '&nationality=' + nationality;
			error_alert = 'There was an error adding the author. Please try again.';
			
		}
		
		$.ajax({
			type: "POST",
			url: load_url,
			data: dataString,
			success: function(msg) {
				// Activate the submit button
				$('#add-edit-form #submit').attr("disabled", "");				
				
				show_view('/main/authors');
				
				return;
			},
			error: function(ob,errStr) {
				$('#add-edit-form #formProgress').html('');
				alert(error_alert);
				
				// Activate the submit button
				$('#add-edit-form #submit').attr("disabled", "");
				
				return;
			}
		});
		
		return false;
	});
	
  // Routines for the add new book button
  $('li#button.button').live("click", function() {
    // change the state of the element
	$("div#add-edit-form").toggle(true);
	$("div#authors-list").css({"top":"85px"});
	$("div#add-edit-form").attr("edit","false");
	$("div#add-edit-form").attr("author_id","");
  });
  
  $('div#submit-close').live("click",function() {
	 	$("div#add-edit-form").toggle(false);
		$("div#authors-list").css({"top":"45px"});			
  });
  
  $('li#button.button').live("hover", function() {
    // change the state of the "#idd"
    $(this).css('cursor','pointer');
  });
  //-------------------------------------
  
  // Routines for the deletes buttons
  $('td#delete').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/delete-user-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#delete').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/delete-user.png\')');
  });
  
  $('td#delete').live("click", function() {		
    //	call the removing routine
		
    	var dataString = 'authid='+ $(this).attr("value");
		$.ajax({
			type: "POST",
			url: "authors/delete_author",
			data: dataString,
			success: function(msg) {

				//$('#body-container').html(msg);
				show_view('/main/authors');

			},
			error: function(ob,errStr) {
				alert('There was an error deleting the author. Please try again.');
			}
		});
		
		return false;

  });
  
  //---------------------------------
  
  
   // Routines for the edit buttons
  $('td#edit').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/edit-user-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#edit').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/edit-user.png\')');
  });
  
  $('td#edit').live("click", function() {		
    //	call the removing routine

		$("div#add-edit-form").toggle(true);
		$("div#authors-list").css({"top":"85px"});
		$("div#add-edit-form").attr("edit","true");
		$("div#add-edit-form").attr("author_id",$(this).attr("value"));
		
		$("input#authorname").val($(this).parent().find('#name').html());
		$("input#nationality").val($(this).parent().find('#nat').html());
		
  });
  //---------------------------------
  
  
  // Routines for the books buttons
  $('td#books').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#books').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question.png\')');
  });
  
  $('td#books').live("click", function() {		
    //	call the removing routine

	alert("Functionality not yet available!");
  });
  //---------------------------------