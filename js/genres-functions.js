// JavaScript Document

	$('#genre-add-edit-form #submit').live("click",function() {
		// Fade in the progress bar
		$('#genre-add-edit-form #formProgress').hide();
		$('#genre-add-edit-form #formProgress').html('<img src="/assets/images/ajax-loader.gif" style="margin:10px;"/> Sending&hellip;');
		$('#genre-add-edit-form #formProgress').fadeIn();
		
		// Disable the submit button
		$('#genre-add-edit-form #submit').attr("disabled", "disabled");
		
		// Clear and hide any error messages
		//$('#genre-add-edit-form .formError').html('');
		
		// Set temaprary variables for the script
		var isFocus=0;
		var isError=0;
		
		// Get the data from the form
		var name=$('#genre-add-edit-form #genre').val();
		var id=$('#genre-add-edit-form').attr('genre_id');
		
		// Validate the data
		if(name=='') {
			$('#genre-add-edit-form #genre').val('This is a required field.');
			$('#genre-add-edit-form #genre').focus();
			$('#genre-add-edit-form #genre').css("background","red");
			
			isFocus=1;
			isError=1;
		}
		
		// Terminate the script if an error is found
		if(isError==1) {
			$('#genre-add-edit-form #formProgress').html('');
			$('#genre-add-edit-form #formProgress').hide();
			
			// Activate the submit button
			$('#genre-add-edit-form #submit').attr("disabled", "");
			
			return false;
		}
		
		$.ajaxSetup ({
			cache: false
		});
		
		var dataString = '';
		var load_url = '';
		var error_alert = '';
					
		if($("div#genre-add-edit-form").attr("edit")=='true') { 
			load_url="genres/edit_genre";
			dataString = 'genre='+ name + '&id=' + id;
			error_alert = 'There was an error editing the genre. Please try again.';
			
		} else {
			load_url="genres/add_genre";
			dataString = 'genre='+ name;
			error_alert = 'There was an error adding the genre. Please try again.';
			
		}
		
		$.ajax({
			type: "POST",
			url: load_url,
			data: dataString,
			success: function(msg) {
				// Activate the submit button
				$('#genre-add-edit-form #submit').attr("disabled", "");				
				
				$('div#body-container').html(msg);
				//show_view('/main/genres');
				
				return;
			},
			error: function(ob,errStr) {
				$('#genre-add-edit-form #formProgress').html('');
				alert(error_alert);
				
				// Activate the submit button
				$('#genre-add-edit-form #submit').attr("disabled", "");
				
				return;
			}
		});
		
		return false;
	});
	
  // Routines for the add new book button
  $('li#button.button').live("click", function() {
    // change the state of the element
	$("div#genre-add-edit-form").toggle(true);
	$("div#genres-list").css({"top":"85px"});
	$("div#genre-add-edit-form").attr("edit","false");
	$("div#genre-add-edit-form").attr("genre_id","");
	$('input#genre').focus();
  });
  
  $('div#submit-close').live("click",function() {
	 	$("div#genre-add-edit-form").toggle(false);
		$("div#genres-list").css({"top":"45px"});

		$('#genre-add-edit-form #genre').val("");
  });
  
  $('li#button.button').live("hover", function() {
    // change the state of the "#idd"
    $(this).css('cursor','pointer');
  });
  //-------------------------------------
  
  // Routines for the deletes buttons
  $('td#delete-genre').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/genre-minus-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#delete-genre').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/genre-minus.png\')');
  });
  
  $('td#delete-genre').live("click", function() {		
    //	call the removing routine
		
    	var dataString = 'genreid='+ $(this).attr("value");
		$.ajax({
			type: "POST",
			url: "genres/delete_genre",
			data: dataString,
			success: function(msg) {

				$('div#body-container').html(msg);
				//show_view('/main/genres');

			},
			error: function(ob,errStr) {
				alert('There was an error deleting the genre. Please try again.');
			}
		});
		
		return false;

  });
  
  //---------------------------------
  
  
   // Routines for the edit buttons
  $('td#edit-genre').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/genre-pencil-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#edit-genre').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/genre-pencil.png\')');
  });
  
  $('td#edit-genre').live("click", function() {		
    //	call the removing routine

		$("div#genre-add-edit-form").toggle(true);
		$("div#genres-list").css({"top":"85px"});
		$("div#genre-add-edit-form").attr("edit","true");
		$("div#genre-add-edit-form").attr("genre_id",$(this).attr("value"));
		
		$("input#genre").val($(this).parent().find('#name').html());
		
		$('input#genre').focus();
		
  });
  //---------------------------------
  
  
  // Routines for the books buttons
  $('td#books-genre').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question-hover.png\')');
    $(this).css('cursor','pointer');
  });
  
  $('td#books-genre').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-question.png\')');
  });
  
  $('td#books-genre').live("click", function() {		
    //	call the removing routine

	alert("Functionality not yet available!");
  });
  //---------------------------------