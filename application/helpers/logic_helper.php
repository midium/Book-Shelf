<?php

function loadView($view,$data=''){
    $CI =& get_instance();
    
	$CI->load->view('partials/head',$data);
	$CI->load->view($view,$data);
	$CI->load->view('partials/foot');
}

?>
