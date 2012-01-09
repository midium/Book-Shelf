// JavaScript Document

	$('#book-add-edit-form td#commit').live("click",function() {
		// Fade in the progress bar
		$('#book-add-edit-form #formProgress').hide();
		$('#book-add-edit-form #formProgress').html('<img src="/assets/images/ajax-loader.gif"/> Sending&hellip;');
		$('#book-add-edit-form #formProgress').fadeIn();
		
		// Disable the submit button
		$('#book-add-edit-form #submit').attr("disabled", "disabled");
		
		// Set temaprary variables for the script
		var isFocus=0;
		var isError=0;
		
		// Get the data from the form
		var id=$('#book-add-edit-form').attr('book_id');
		
		var title=$('#book-add-edit-form #title').val();
		var original=$('#book-add-edit-form #original-title').val();
		var author=$('#book-add-edit-form #author').attr('auth_id');
		var author_name=$('#book-add-edit-form #author').val();
		var publisher=$('#book-add-edit-form #publisher').attr('pub_id');
		var publisher_name=$('#book-add-edit-form #publisher').val();
		var genres=$('#book-add-edit-form #genre-tags').val();
		var pages=$('#book-add-edit-form #pages').val();
		var year=$('#book-add-edit-form #year').val();
		var buyed=$('#book-add-edit-form #buyed').val();
		var vote=0;
		$('#book-add-form input.star').each(function(){
			if(this.checked) vote= this.value;
		});
		var description=$('#book-add-edit-form #description').val();
		var cover=$('img#show-cover').attr('src');
		
		// Validate the data
		if(title=='') {
			$('#book-add-edit-form #title').val('This is a required field.');
			$('#book-add-edit-form #title').focus();
			$('#book-add-edit-form #title').css("background","red");
			
			isFocus=1;
			isError=1;
		}
		
		/*TODO: think on which data I need to add a validation*/
		
		// Terminate the script if an error is found
		if(isError==1) {
			$('#book-add-edit-form #formProgress').html('');
			$('#book-add-edit-form #formProgress').hide();
			
			// Activate the submit button
			$('#book-add-edit-form #submit').attr("disabled", "");
			
			return false;
		}

		$.ajaxSetup ({
			cache: false
		});
		
		var dataString = '';
		var load_url = '';
		var error_alert = '';
					
		if($("div#book-add-edit-form").attr("edit")=='true') { 
			load_url="books/edit_book";
			dataString = 'title='+title+'&original='+original+'&auth_id='+author+'&pub_id='+publisher+'&genres='+genres+'&pages='+pages+'&vote='+vote+'&description='+description+'&year='+year+'&buyed='+buyed+'&cover='+cover+'&id=' + id+'&author='+author_name+'&publisher='+publisher_name;
			error_alert = 'There was an error editing the book. Please try again.';
			
		} else {
			load_url="books/add_book";

			dataString = 'title='+title+'&original='+original+'&auth_id='+author+'&pub_id='+publisher+'&genres='+genres+'&pages='+pages+'&vote='+vote+'&description='+description+'&year='+year+'&buyed='+buyed+'&cover='+cover+'&author='+author_name+'&publisher='+publisher_name;
			error_alert = 'There was an error adding the book. Please try again.';
			
		}
		
		$.ajax({
			type: "POST",
			url: load_url,
			data: dataString,
			success: function(msg) {

				// Activate the submit button
				$('#book-add-edit-form #submit').attr("disabled", "");				
				
				$('div#body-container').html(msg);
				
				return;
			},
			error: function(ob,errStr) {
				$('#book-add-edit-form #formProgress').html('');
				alert(error_alert);
				
				// Activate the submit button
				$('#book-add-edit-form #submit').attr("disabled", "");
				
				return;
			}
		});
		
		return false;
	});
	
  // Routines for the add new book button
  $('li#book-button.button').live("click", function() {
    // change the state of the element
	if(!$(this).is('[disabled]')) {
		$("div#book-add-edit-form").toggle(true);
		$("div#books-list").css({"top":"385px"});
		$("div#book-add-edit-form").attr("edit","false");
		$("div#book-add-edit-form").attr("book_id","");
		
		$("div#book-add-edit-form input#title").focus();
		
		$('li#search-button.button').attr("disabled", true);
	}
  });
  
  $('td#abort').live("click",function() {
	 	$("div#book-add-edit-form").toggle(false);
		$("div#books-list").css({"top":"45px"});
		
		$('#book-add-edit-form #formProgress').hide();
		
		$('li#search-button.button').removeAttr("disabled");

		$('#book-add-edit-form #title').val("");
		$('#book-add-edit-form #original-title').val("");
		$('#book-add-edit-form #author').val("");
		$('#book-add-edit-form #publisher').val("");
		$('#book-add-edit-form #genre-tags').importTags("");
		$('#book-add-edit-form #pages').val("");
		$('#book-add-edit-form #vote').val("");
		$('#book-add-edit-form #description').val("");
		$('input#year').val("");
		$('input#buyed').val("");
		
		var height = parseInt($('td#tmp-cover').css('height'));
		$('img#show-cover').css('height', (height-5)+'px');
		$('img#show-cover').attr('src','/assets/covers/nocover.cvr');
  });
  
  $('li#book-button.button').live("hover", function() {
    // change the state of the "#idd"
    $(this).css('cursor','pointer');
  });
  //-------------------------------------
  
    
  // Routines for the deletes buttons
  $('div#book-delete').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-minus-hover.png\')');
  });
  
  $('div#book-delete').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-minus.png\')');
  });
  
  $('div#book-delete').live("click", function() {		
    //	call the removing routine
    	var dataString = 'bookid='+ $(this).attr("value");
		$.ajax({
			type: "POST",
			url: "books/delete_book",
			data: dataString,
			success: function(msg) {

				$('div#body-container').html(msg);

			},
			error: function(ob,errStr) {
				alert('There was an error deleting the book. Please try again.');
			}
		});
		
		return false;

  });
  
  //---------------------------------
  
  
   // Routines for the edit buttons
  $('div#book-edit').live("mouseenter", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-pencil-hover.png\')');
  });
  
  $('div#book-edit').live("mouseleave", function() {
    // change the state of the "#idd"
	$(this).css('background-image','url(\'/assets/images/icons/book-pencil.png\')');
  });
  
  $('div#book-edit').live("click", function() {		
    //	call the removing routine
		$("div#book-add-edit-form").toggle(true);
		$("div#books-list").css({"top":"395px"});
		$("div#book-add-edit-form").attr("edit","true");
		$("div#book-add-edit-form").attr("book_id",$(this).attr("value"));
		
		//TODO: Take a look how I can parse the JSON formatted returned values;
		var dataString = 'bookid='+ $(this).attr("value");
		var book_id = $(this).attr("value");
		$.ajax({
			type: "POST",
			url: "books/get_book_details",
			data: dataString,
			success: function(msg) {

				json_return = eval('('+msg+')');

				$('input#title').val(json_return.title);
				$('input#original-title').val(json_return.original);
				$('input#author').val(json_return.author);
				$('input#author').attr('auth_id',json_return.author_id);
				$('input#publisher').val(json_return.publisher);
				$('input#publisher').attr('pub_id',json_return.publisher_id);
				$('input#genre-tags').importTags(json_return.genres);
				$('input#pages').val(json_return.pages);
				
				var vote_value = json_return.vote;
				//First I set them all not selected so that I start from a blank situation
				for(i=0;i<=10;i++) {
					$('div#'+i).attr('class','star-rating rater-0 star star-rating-applied star-rating-live');
					var cur = i-1;
					$('td#vote-value input:radio:nth('+cur+')').removeAttr('checked');
				}
				//Now I set the currect value
				for(i=0;i<=vote_value;i++) {
					$('div#'+i).attr('class','star-rating rater-0 star star-rating-applied star-rating-live star-rating-on');
				}
				vote_value--;
				$('td#vote-value input:radio:nth('+vote_value+')').attr('checked','checked');
				
				var height = parseInt($('td#tmp-cover').css('height'));
				$('img#show-cover').css('height', (height-5)+'px');
				$('img#show-cover').attr('src','/assets/covers/'+book_id+'.cvr');

				$('input#year').val(json_return.year);
				$('input#buyed').val(json_return.buyed);

				$('textarea#description').val(json_return.description);

			},
			error: function(ob,errStr) {
				alert('There was an error editing the book. Please try again.');
			}
		});
				
		$('input#title').focus();
		
  });
    

  $('td#delete-cover').live('click',function(){
	var height = parseInt($('td#tmp-cover').css('height'));
	$('img#show-cover').css('height', (height-5)+'px');
	$('img#show-cover').attr('src','/assets/covers/nocover.cvr');
  });

  //---------------------------------
  
  //------------------SEARCH----------------------
  $('li#search-button.button').live("click", function() {
    // change the state of the element
	if(!$(this).is('[disabled]')) {
		$("div#book-search-form").toggle(true);
		$("div#books-list").css({"top":"169px"});
		
		$('li#book-button.button').attr("disabled", true);
		
		$('input#title-search').focus();
	}
  });
  
  $('div#abort-search').live("click",function() {
	 	$("div#book-search-form").toggle(false);
		$("div#books-list").css({"top":"45px"});
		
		$('#book-search-form #formProgress').hide();
		
		$('li#book-button.button').removeAttr("disabled");

		$('input#title-search').val("");
		$('input#author-search').val("");
		$('input#publisher-search').val("");
		$('input#genre-search').importTags("");
		$('input#pages-search').val("");

  });

  $('div#commit-search').live("click",function() {
	 	$("div#book-search-form").toggle(false);
		$("div#books-list").css({"top":"45px"});
		
		$('#book-search-form #formProgress').hide();	
		
		$('li#book-button.button').removeAttr("disabled");
		$('li#all-button.button').toggle(true);
		
		var title=$('#book-search-form #title-search').val();
		var title_where=$('select#title-where').val();
		var author=$('#book-search-form #author-search').val();
		var author_where=$('select#author-where').val();
		var publisher=$('#book-search-form #publisher-search').val();
		var publisher_where=$('select#publisher-where').val();
		var genres=$('#book-search-form #genre-search').val();
		var genres_where=$('select#genre-where').val();
		var pages=$('#book-search-form #pages-search').val();
		var pages_where=$('select#pages-where').val();
		var vote=0;
		$('#book-search-form input.star').each(function(){
			if(this.checked) vote= this.value;
		});
		var vote_where=$('select#vote-where').val();
		
		var dataString = 'title='+title+'&author='+author+'&publisher='+publisher+'&genres='+genres+'&pages='+pages+'&vote='+vote+
						 '&title_where='+title_where+'&author_where='+author_where+'&publisher_where='+publisher_where+
						 '&genres_where='+genres_where+'&pages_where='+pages_where+'&vote_where='+vote_where;
		
		$.ajax({
			type: "POST",
			url: 'books/find_books',
			data: dataString,
			success: function(msg) {

				//alert(msg);return;

				$('div#body-container').html(msg);
				//show_view('/main/books');
				
				return;
			},
			error: function(ob,errStr) {
				$('#book-search-form #formProgress').html('');
				alert('There have been errors searching the books!');
				
				return;
			}
		});
		
		return false;
	
  });

  $('li#all-button.button').live("click", function() {
    // change the state of the "#idd"
	show_view('/main/books');
  });
  
  $('li#book-button.button').live("hover", function() {
    // change the state of the "#idd"
    $(this).css('cursor','pointer');
  });
