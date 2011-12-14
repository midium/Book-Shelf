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
		
		$data['login_page']=false;		
		loadView('main/bookshelf_main',$data);
	}

	public function showView() {
		$this->load->helper('logic');
		$CI =& get_instance();

		if ($CI->session->userdata('login_params')){
			$data = $CI->session->userdata('login_params');
		}
		$data['login_page']=false;
		
		$view_name = $this->input->post('view');
		
		$this->load->model('mongo_manage','',true);

		switch ($view_name) {
			case '/main/books':
				
				break;
				
			case '/main/authors':
				$data['authors']=$this->mongo_manage->getAuthorsList();
			
				break;
				
			case '/main/add_edit_author':
				$data['edit']=false;
				
				break;
				
			default:
				break;
		}

		$CI->load->view($view_name,$data);
	}
}

?>