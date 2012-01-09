<?php 

class Publishers extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
    }

	public function add_publisher(){
		$CI =& get_instance();
		
		$publisher = $this->input->post('publisher');
		$email = $this->input->post('email');
		$web = $this->input->post('web');

		$this->mongo_manage->addPublisher($publisher, $email, $web);

		$data['login_page']=false;
		$data['publishers']=$this->mongo_manage->getPublishersList();

		if ($data['publishers']!='') {
			$CI->load->view('/main/publishers',$data);
		} else {
			
		}
	}
	
	public function delete_publisher(){
		$CI =& get_instance();
		
		$publisher_id = $this->input->post('pubid');

		$this->mongo_manage->deletePublisher($publisher_id);

		$data['login_page']=false;
		$data['publishers']=$this->mongo_manage->getPublishersList();

		if ($data['publishers']!='') {
			$CI->load->view('/main/publishers',$data);
		} else {
			
		}
	}
	
	public function edit_publisher(){
		$CI =& get_instance();
		
		$publisher = $this->input->post('publisher');
		$email = $this->input->post('email');
		$web = $this->input->post('web');
		$publisher_id = $this->input->post('id');
		
		$this->mongo_manage->editPublisher($publisher_id, $publisher, $email, $web);

		$data['login_page']=false;
		$data['publishers']=$this->mongo_manage->getPublishersList();

		if ($data['publishers']!='') {
			$CI->load->view('/main/publishers',$data);
		} else {
			
		}
	}
}