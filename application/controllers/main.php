<?php 

class Main extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->load->helper('logic');
		$CI =& get_instance();

		if ($CI->session->userdata('login_params')){
			$data = $CI->session->userdata('login_params');
		}
		loadView('main/under_construction',$data);
	}

}

?>