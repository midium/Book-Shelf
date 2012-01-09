<?php 

class Books extends MY_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('mongo_manage','',true);
    }

	public function add_book(){
		$CI =& get_instance();

		$insert['title'] = $this->input->post('title');
		$insert['original'] = $this->input->post('original');
		$insert['author'] = $this->input->post('author');
		$insert['publisher'] = $this->input->post('publisher');
		$insert['genres'] = $this->input->post('genres');
		$insert['pages'] = (int)$this->input->post('pages');
		$insert['vote'] = (int)$this->input->post('vote');
		$insert['description'] = $this->input->post('description');
		$insert['year'] = (int)$this->input->post('year');
		$insert['buyed'] = (int)$this->input->post('buyed');
		
		//1st: Checking Genres
		if ($insert['genres']!='') {
			$genres = explode(",",$insert['genres']);
			
			if(count($genres)>0) {
				foreach($genres as $genre) {
					if (!$this->mongo_manage->existGenre($genre)) {
						$this->mongo_manage->addGenre($genre);
					}
				}
			}
		}
		
		//2nd: Checking Authors
		$author = $this->input->post('author');
		if ($author!='') {
			if (!$this->mongo_manage->existAuthor($author)) {
				$this->mongo_manage->addAuthor($author,'');
				
				//$insert['author']=''.$this->mongo_manage->getAuthorIDbyName($author);
			}
		}


		//3rd: Checking Publishers
		$publisher = $this->input->post('publisher');
		if ($publisher!='') {
			if (!$this->mongo_manage->existPublisher($publisher)) {
				$this->mongo_manage->addPublisher($publisher,'','');
				
				//$insert['publisher']=''.$this->mongo_manage->getPublisherIDbyName($publisher);
			}
		}

		//I add the book
		$this->mongo_manage->addBook($insert);
		
		//I rename the cover
		$book_id = $this->mongo_manage->getBookIDbyTitle($insert['title']);
		if((''.$book_id)!='-1') {
			$tmp_cover = '.'.$this->input->post('cover');
			if(strpos($tmp_cover,'nocover')==false){
				$destination = './assets/covers/'.$book_id.'.cvr';						
				
				copy($tmp_cover,$destination);
				unlink($tmp_cover);
			}
						
		} else {
			
		}

		$data['login_page']=false;
		$data['books']=$this->mongo_manage->getBooksList();

		if ($data['books']!='') {
			$CI->load->view('/main/books',$data);
		} else {
			
		}
	}
	
	public function get_book_details(){
		$CI =& get_instance();
		
		$book_id = $this->input->post('bookid');		
		$book = $this->mongo_manage->getBookFromID($book_id);
		
		$return['title']='';
		$return['original']='';
		$return['author']='';
		$return['author_id']='';
		$return['publisher']='';
		$return['publisher_id']='';
		$return['genres']='';
		$return['pages']='';
		$return['vote']='';
		$return['year']='';
		$return['buyed']='';
		$return['description']='';
			
		if (isset($book)) {
			$return['title']=$book[0]->title;
			$return['original']=$book[0]->original;
			$return['author']=$book[0]->author;
			$return['author_id']=$book[0]->author;
			$return['publisher']=$book[0]->publisher;
			$return['publisher_id']=$book[0]->publisher;
			$return['genres']=$book[0]->genres;
			$return['pages']=$book[0]->pages;
			$return['vote']=$book[0]->vote;
			$return['year']=$book[0]->year;
			$return['buyed']=$book[0]->buyed;
			$return['description']=$book[0]->description;
		}

		echo json_encode($return);
	}
	
	public function delete_book(){
		$CI =& get_instance();
		
		$book_id = $this->input->post('bookid');

		$this->mongo_manage->deleteBook($book_id);
		//Deleting cover
		unlink('./assets/covers/'.$book_id.'.cvr');

		$data['login_page']=false;
		$data['books']=$this->mongo_manage->getBooksList();

		if ($data['books']!='') {
			$CI->load->view('/main/books',$data);
		} else {
			
		}
	}
	
	public function edit_book(){
		$CI =& get_instance();

		$insert['title'] = $this->input->post('title');
		$insert['original'] = $this->input->post('original');
		$insert['author'] = $this->input->post('author');
		$insert['publisher'] = $this->input->post('publisher');
		$insert['genres'] = $this->input->post('genres');
		$insert['pages'] = (int)$this->input->post('pages');
		$insert['vote'] = (int)$this->input->post('vote');
		$insert['description'] = $this->input->post('description');
		$insert['year'] = (int)$this->input->post('year');
		$insert['buyed'] = (int)$this->input->post('buyed');

		$book_id = $this->input->post('id');
		
		//1st: Checking Genres
		if ($insert['genres']!='') {
			$genres = explode(",",$insert['genres']);
			
			if(count($genres)>0) {
				foreach($genres as $genre) {
					if (!$this->mongo_manage->existGenre($genre)) {
						$this->mongo_manage->addGenre($genre);
					}
				}
			}
		}
		
		//2nd: Checking Authors
		$author = $this->input->post('author');
		if ($author!='') {
			if (!$this->mongo_manage->existAuthor($author)) {
				$this->mongo_manage->addAuthor($author,'');
				
				//$insert['author']=''.$this->mongo_manage->getAuthorIDbyName($author);
			}
		}


		//3rd: Checking Publishers
		$publisher = $this->input->post('publisher');
		if ($publisher!='') {
			if (!$this->mongo_manage->existPublisher($publisher)) {
				$this->mongo_manage->addPublisher($publisher,'','');
				
				//$insert['publisher']=''.$this->mongo_manage->getPublisherIDbyName($publisher);
			}
		}
		
		$this->mongo_manage->editBook($book_id, $insert);

		//Fixing cover if needed
		$tmp_cover = '.'.$this->input->post('cover');
		if(strpos($tmp_cover,'nocover')==false){
			$destination = './assets/covers/'.$book_id.'.cvr';						
		
			if (strpos($tmp_cover, $book_id)==false) {
				copy($tmp_cover,$destination);
				unlink($tmp_cover);
			}
		}

		$data['login_page']=false;
		$data['books']=$this->mongo_manage->getBooksList();

		if ($data['books']!='') {
			$CI->load->view('/main/books',$data);
		} else {
			
		}
	}
	
	public function find_books(){
		$CI =& get_instance();

		$search['title'] = $this->input->post('title');
		$search['author'] = $this->input->post('author');
		$search['publisher'] = $this->input->post('publisher');
		$search['genres'] = $this->input->post('genres');
		$search['pages'] = $this->input->post('pages');
		$search['vote'] = $this->input->post('vote');

		$where['title'] = $this->input->post('title_where');
		$where['author'] = $this->input->post('author_where');
		$where['publisher'] = $this->input->post('publisher_where');
		$where['genres'] = $this->input->post('genres_where');
		$where['pages'] = $this->input->post('pages_where');
		$where['vote'] = $this->input->post('vote_where');
				
		$data['login_page']=false;
		$data['books_searched']=true;
		$books_finded=$this->mongo_manage->findBooks($search, $where);
		
		if ($books_finded!='') {
			$data['books']=$books_finded;
		}

		$CI->load->view('/main/books',$data);
	}
		
	public function upload_cover() {
		$CI =& get_instance();
		
		$CI->load->helper('logic');
		
		$uploaddir = './assets/covers/';
		$uploadfile = $uploaddir . 'tmp.img';
		$allowed_types = 'gif|jpg|png';
		
		$file_ext = file_extension($_FILES['myfile']['name']);
		if (strpos($allowed_types,$file_ext)==false) {
			echo json_encode(array('response'=>'error', 'value'=>'Just GIF, JPG and PNG files are allowed!'));
		} else {
			if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
			  echo json_encode(array('response'=>'success', 'value'=>'tmp.img'));
			} else {
			  echo json_encode(array('response'=>'error', 'value'=>'An error has occurred uploading the image!'));
			}
		}

	}
	
	public function get_author_books(){
		$CI =& get_instance();
		
		$search['title'] = '';
		$search['author'] = $this->input->post('author');
		$search['publisher'] = '';
		$search['genres'] = '';
		$search['pages'] = '';
		$search['vote'] = '';

		$where['title'] = '';
		$where['author'] = 'like';
		$where['publisher'] = '';
		$where['genres'] = '';
		$where['pages'] = '';
		$where['vote'] = '';
		
		$data['login_page']=false;
		$data['books_searched']=true;
		$data['author_name']=$search['author'];
		$books_finded=$this->mongo_manage->findBooks($search, $where);

		if ($books_finded!='') {
			$data['books']=$books_finded;
		}

		$CI->load->view('/main/books',$data);
	}
	
	public function get_publisher_books(){
		$CI =& get_instance();
		
		$search['title'] = '';
		$search['author'] = '';
		$search['publisher'] = $this->input->post('publisher');
		$search['genres'] = '';
		$search['pages'] = '';
		$search['vote'] = '';

		$where['title'] = '';
		$where['author'] = '';
		$where['publisher'] = 'like';
		$where['genres'] = '';
		$where['pages'] = '';
		$where['vote'] = '';
		
		$data['login_page']=false;
		$data['books_searched']=true;
		$data['publisher']=$search['publisher'];
		$books_finded=$this->mongo_manage->findBooks($search, $where);

		if ($books_finded!='') {
			$data['books']=$books_finded;
		}

		$CI->load->view('/main/books',$data);
	}
	
	public function get_genre_books(){
		$CI =& get_instance();
		
		$search['title'] = '';
		$search['author'] = '';
		$search['publisher'] = '';
		$search['genres'] = $this->input->post('genre');
		$search['pages'] = '';
		$search['vote'] = '';

		$where['title'] = '';
		$where['author'] = '';
		$where['publisher'] = '';
		$where['genres'] = 'like';
		$where['pages'] = '';
		$where['vote'] = '';
		
		$data['login_page']=false;
		$data['books_searched']=true;
		$data['genre']=$search['genres'];
		$books_finded=$this->mongo_manage->findBooks($search, $where);

		if ($books_finded!='') {
			$data['books']=$books_finded;
		}

		$CI->load->view('/main/books',$data);
	}
}