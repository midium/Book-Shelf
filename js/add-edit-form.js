  // when click on the tag with id="btn"
  $('li#button.button').live("click", function() {
    // change the state of the element
	if ($("div#add-edit-form").css("display") == "none") {
		$("div#add-edit-form").toggle(true);
		$("div#authors-list").css({"top":"85px"});
		$("input#authorname").focus();
	} else {
		$("div#add-edit-form").toggle(false);
		$("div#authors-list").css({"top":"45px"});
	}
  });
  
  $('li#button.button').live("hover", function() {
    // change the state of the "#idd"
    $('li#button.button').css('cursor','pointer');
  });