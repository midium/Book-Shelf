<?php 

class Genres extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
    }

	public function add_genre(){
		$CI =& get_instance();
		
		$genre = $this->input->post('genre');

		$this->mongo_manage->addGenre($genre);

		$data['login_page']=false;
		$data['genres']=$this->mongo_manage->getGenresList();

		if ($data['genres']!='') {
			$CI->load->view('/main/genres',$data);
		} else {
			
		}
	}
	
	public function delete_genre(){
		$CI =& get_instance();
		
		$genre_id = $this->input->post('genreid');

		$this->mongo_manage->deleteGenre($genre_id);

		$data['login_page']=false;
		$data['genres']=$this->mongo_manage->getGenresList();

		if ($data['genres']!='') {
			$CI->load->view('/main/genres',$data);
		} else {
			
		}
	}
	
	public function edit_genre(){
		$CI =& get_instance();
		
		$genre = $this->input->post('genre');
		$genre_id = $this->input->post('id');
		
		$this->mongo_manage->editGenre($genre_id, $genre);

		$data['login_page']=false;
		$data['genres']=$this->mongo_manage->getGenresList();

		if ($data['genres']!='') {
			$CI->load->view('/main/genres',$data);
		} else {
			
		}
	}
}