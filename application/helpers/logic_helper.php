<?php

function loadView($view,$data=''){
    $CI =& get_instance();

	$CI->load->view('partials/head',$data);
	$CI->load->view($view,$data);
	$CI->load->view('partials/foot');
}

function flash_message()
{
	// get flash message from CI instance
	$ci =& get_instance();
	$flashmsg = $ci->session->userdata('message');
	//I destroy it to avoid it to appear within a new refresh
	$ci->session->unset_userdata('message');
	
	$html = '';
	if (is_array($flashmsg))
	{
		$html = '<div id="flashmessage" class="'.$flashmsg['type'].'">
			<img style="float: right; cursor: pointer" id="closemessage" src="/assets/images/icons/cross.png" />
			<strong><b>'.$flashmsg['title'].'</b></strong>
			<p>'.$flashmsg['content'].'</p>
			</div>';
	}
	
	return $html;
}
?>
