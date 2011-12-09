<?php 

class Main extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->helper('logic');

		loadView('main/under_construction');
	}

}

?>