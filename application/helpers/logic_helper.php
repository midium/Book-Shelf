<?php

function loadView($view,$data=''){
    $CI =& get_instance();
    
	$CI->load->view('partials/head');
	$CI->load->view($view,$data);
	$CI->load->view('partials/foot');
}

?>
