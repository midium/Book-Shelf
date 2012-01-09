$(function(){ 
	$('#book-add-form :radio.star').rating();
	$('#book-search-form :radio.star').rating();
    
  // AUTOCOMPLETE ROUTINES
  $("input#author").autocomplete({
		source: "autocomplete/authors",
		minLength: 2,//search after two characters
		select: function(event,ui){
			$(this).val(ui.item.value);
			$(this).attr("auth_id",ui.item.id);
    }
  });

  $("input#publisher").autocomplete({
		source: "autocomplete/publishers",
		minLength: 2,//search after two characters
		select: function(event,ui){
			$(this).val(ui.item.value);
			$(this).attr("pub_id",ui.item.id);
    }
  });
  
  $('#genre-tags').tagsInput({
	  autocomplete_url:'autocomplete/genres',
	  minChars: 2,
	  defaultText: 'Add a genre',
	  removeWithBackspace : true,
	  placeholderColor : '#666666',
	  height: '19px',
	  width: '98.5%'
  });
  
  $("input#author-search").autocomplete({
		source: "autocomplete/authors",
		minLength: 2,//search after two characters
		select: function(event,ui){
			$(this).val(ui.item.value);
			$(this).attr("auth_id",ui.item.id);
    }
  });

  $("input#publisher-search").autocomplete({
		source: "autocomplete/publishers",
		minLength: 2,//search after two characters
		select: function(event,ui){
			$(this).val(ui.item.value);
			$(this).attr("pub_id",ui.item.id);
    }
  });
  
  $('#genre-search').tagsInput({
	  autocomplete_url:'autocomplete/genres',
	  minChars: 2,
	  defaultText: 'Add a genre',
	  removeWithBackspace : true,
	  placeholderColor : '#666666',
	  height: '19px',
	  width: '98.5%'
  });
  //---------------------------------
  
  //---------COVER UPLOAD------------
	new AjaxUpload('#choose-cover',{
		action: 'books/upload_cover', 
		name: 'myfile',

		onSubmit : function(file, ext){
			// If you want to allow uploading only 1 file at time,
			// you can disable upload button
			this.disable();
		},

		onComplete: function(file, response){
			json_return = eval('('+response+')');		
			
			if (json_return.response!='success') {
				alert(json_return.value);
			} else {
				var height = parseInt($('td#tmp-cover').css('height'));
				$('img#show-cover').css('height', (height-5)+'px');
				$('img#show-cover').attr('src','/assets/covers/'+json_return.value);
			}

			// enable upload button
			this.enable();

		}

	});
  //----------------------
})