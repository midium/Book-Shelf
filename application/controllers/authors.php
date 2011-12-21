<?php 

class Authors extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
    }

	public function add_author(){
		$CI =& get_instance();
		
		$author = $this->input->post('authorname');
		$nationality = $this->input->post('nationality');

		$this->mongo_manage->addAuthor($author, $nationality);

		$data['login_page']=false;
		$data['authors']=$this->mongo_manage->getAuthorsList();

		if ($data['authors']!='') {
			$CI->load->view('/main/authors',$data);
		} else {
			
		}
	}
	
	public function delete_author(){
		$CI =& get_instance();
		
		$author_id = $this->input->post('authid');

		$this->mongo_manage->deleteAuthor($author_id);

		$data['login_page']=false;
		$data['authors']=$this->mongo_manage->getAuthorsList();

		if ($data['authors']!='') {
			$CI->load->view('/main/authors',$data);
		} else {
			
		}
	}
	
	public function edit_author(){
		$CI =& get_instance();
		
		$author = $this->input->post('authorname');
		$nationality = $this->input->post('nationality');
		$author_id = $this->input->post('id');
		
		//$this->mongo_manage->deleteAuthor($author_id);
		//$this->mongo_manage->addAuthor($author, $nationality);
		
		//Need to check why it won't work this way		
		$this->mongo_manage->editAuthor($author_id, $author, $nationality);

		$data['login_page']=false;
		$data['authors']=$this->mongo_manage->getAuthorsList();

		if ($data['authors']!='') {
			$CI->load->view('/main/authors',$data);
		} else {
			
		}
	}
}