<?php 

class Main extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
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
		
		switch ($view_name) {
			case '/main/books':
				$data['books']=$this->mongo_manage->getBooksList();
				break;
				
			case '/main/authors':
				$data['authors']=$this->mongo_manage->getAuthorsList();			
				break;
				
			case '/main/publishers':
				$data['publishers']=$this->mongo_manage->getPublishersList();			
				break;
							
			case '/main/genres':
				$data['genres']=$this->mongo_manage->getGenresList();			
				break;
				
			default:
				break;
		}

		$CI->load->view($view_name,$data);
	}
}

?>