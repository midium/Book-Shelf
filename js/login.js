// JavaScript Document for Login page

// first slide down and blink the message box
$(document).ready(function(){
	$("#flashmessage").animate({top: "0px"}, 1000 ).show('fast').fadeIn(200).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
	$("#closemessage").click( function () { $(this).parent("div").fadeOut("slow"); });
});