<?php 

class Main extends CI_Controller {

	public function index()
	{
		$this->load->helper('logic');
			
		loadView('main/under_construction');
	}
}

?>