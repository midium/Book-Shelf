<?php

class Mongo_Manage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('Mongo_db');
	}

	/*####### PUBLISHERS ROUTINES ########*/
    public function getPublishersList()
    {		
		$publishers = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$publishers = $this->mongo_db->get('publishers');
		}

        return $publishers;
    }
	
    public function searchPublishers($search)
    {		
		$publishers = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->like('name',$search);
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$publishers = $this->mongo_db->get('publishers');
		}

        return $publishers;
    }
	
	public function existPublisher($publisher_name)
    {		
		$result = false;
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where(array('name'=>$publisher_name));
			$publisher = $this->mongo_db->get('publishers');
			
			if(sizeof($publisher)!=0) {
				$result = true;
			} else {
				$result = false;
			}
		}

        return $result;
    }
	
	public function getPublisherFromID($pub_id) {
		$value = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id',$pub_id);
			$publishers = $this->mongo_db->get('publishers');
			
			if (isset($publishers)){
				$value = $publishers[0]->name;
			}
		}
		
		return $value;
	}
	
	public function getPublisherIDbyName($publisher_name)
	{
		$return = '-1';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('name', $publisher_name);
			$publisher = $this->mongo_db->get('publishers');
			$return = $publisher[0]->_id;
		}
		
		return $return;
	}
	
	public function addPublisher($publisher, $email, $web) {
		
		$publisher_data = array('name' => $publisher,
							 	'email' => $email,
								'website' => $web);
							 
		if($this->mongo_db->switch_db('bookshelf')) {
			//Adding author
			$this->mongo_db->insert('publishers',$publisher_data);
			$this->mongo_db->add_index('publishers',array('_id' => 'ASC', 'name' => 'ASC', 'email' => 'ASC', 'website' => 'ASC'));		
		}
		
		return true;
	}
	
	public function deletePublisher($publisher_id) {

		//Removing author
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $publisher_id);
			$this->mongo_db->delete('publishers');
		}
		
		return true;
	}
	
	public function editPublisher($id, $publisher, $email, $web) {
		
		//Setting updates
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $id);
			$this->mongo_db->set('name', $publisher);
			$this->mongo_db->set('email', $email);
			$this->mongo_db->set('website', $web);
			
			//Storing updates
			$this->mongo_db->update('publishers');
		}
		
		return true;
	}
	/*#################################*/
	
	/*####### AUTHORS ROUTINES ########*/
    public function getAuthorsList()
    {		
		$authors = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$authors = $this->mongo_db->get('authors');
		}

        return $authors;
    }
	
    public function searchAuthors($search)
    {		
		$authors = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->like('name',$search);
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$authors = $this->mongo_db->get('authors');
		}

        return $authors;
    }
	
	public function existAuthor($author_name)
    {		
		$result = false;
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where(array('name'=>$author_name));
			$author = $this->mongo_db->get('authors');
			
			if(sizeof($author)!=0) {
				$result = true;
			} else {
				$result = false;
			}
		}

        return $result;
    }
	
	public function getAuthorFromID($auth_id) {
		$value = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id',$auth_id);
			$authors = $this->mongo_db->get('authors');
			
			if (isset($authors)){
				$value = $authors[0]->name;
			}
		}
		
		return $value;
	}
	
	public function getAuthorIDbyName($author_name) 
	{
		$return = '-1';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->like('name', $author_name);
			$author = $this->mongo_db->get('authors');
			$return = $author[0]->_id;
		}
		
		return $return;
	}
	
	public function addAuthor($author, $nationality) {
		
		$author_data = array('name' => $author,
							 'nationality' => $nationality);
							 
		if($this->mongo_db->switch_db('bookshelf')) {
			//Adding author
			$this->mongo_db->insert('authors',$author_data);
			$this->mongo_db->add_index('authors',array('_id' => 'ASC', 'name' => 'ASC', 'nationality' => 'ASC'));		
		}
		
		return true;
	}
	
	public function deleteAuthor($author_id) {

		//Removing author
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $author_id);
			$this->mongo_db->delete('authors');
		}
		
		return true;
	}
	
	public function editAuthor($id, $author, $nationality) {
		
		//Setting updates
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $id);
			$this->mongo_db->set('name', $author);
			$this->mongo_db->set('nationality', $nationality);
			
			//Storing updates
			$this->mongo_db->update('authors');
		}
		
		return true;
	}
	/*#################################*/
		
	/*####### GENRES ROUTINES ########*/
    public function getGenresList()
    {		
		$genres = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$genres = $this->mongo_db->get('genres');
		}

        return $genres;
    }
	
	public function existGenre($genre_name)
    {		
		$result = false;
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where(array('name'=>$genre_name));
			$genre = $this->mongo_db->get('genres');
			
			if(sizeof($genre)!=0) {
				$result = true;
			} else {
				$result = false;
			}
		}

        return $result;
    }

    public function searchGenres($search)
    {		
		$genres = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->like('name',$search);
			$this->mongo_db->order_by(array('name'=>'ASC'));
			$genres = $this->mongo_db->get('genres');
		}

        return $genres;
    }
	
	public function addGenre($genre) {
		
		$genre_data = array('name' => $genre);
							 
		if($this->mongo_db->switch_db('bookshelf')) {
			//Adding author
			$this->mongo_db->insert('genres',$genre_data);
			$this->mongo_db->add_index('genres',array('_id' => 'ASC', 'name' => 'ASC'));
		}
		
		return true;
	}
	
	public function deleteGenre($genre_id) {

		//Removing author
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $genre_id);
			$this->mongo_db->delete('genres');
		}
		
		return true;
	}
	
	public function editGenre($id, $genre) {
		
		//Setting updates
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $id);
			$this->mongo_db->set('name', $genre);
			
			//Storing updates
			$this->mongo_db->update('genres');
		}
		
		return true;
	}
	/*#################################*/

	/*####### BOOKS ROUTINES ########*/
    public function getBooksList()
    {		
		$books = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$books = $this->mongo_db->get('books');
		}
		
        return $books;
    }
	
    public function findBooks($search_values,$where_values)
    {		
		$books = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			//Title
			if($search_values['title']!=''){
				switch($where_values['title']) {
					case 'eql':
						$this->mongo_db->where('title',$search_values['title']);
						break;
					
					case 'like':
						$this->mongo_db->like('title',$search_values['title']);
						break;

				}
			}
			
			//Author
			if($search_values['author']!=''){
				switch($where_values['author']) {
					case 'eql':
						$this->mongo_db->where('author',$search_values['author']);
						break;
					
					case 'like':
						$this->mongo_db->like('author',$search_values['author']);
						break;
						
					case 'not-eql':
						$this->mongo_db->where_ne('author',$search_values['author']);
						break;
				}
			}
			//Publisher
			if($search_values['publisher']!=''){
				switch($where_values['publisher']) {
					case 'eql':
						$this->mongo_db->where('publisher',$search_values['publisher']);
						break;
					
					case 'like':
						$this->mongo_db->like('publisher',$search_values['publisher']);
						break;
						
					case 'not-eql':
						$this->mongo_db->where_ne('publisher',$search_values['publisher']);
						break;
				}
			}
			//Genres
			if($search_values['genres']!=''){
				$genres = explode(',',$search_values['genres']);
				
				switch($where_values['genres']) {
					case 'eql':
						$this->mongo_db->where('genres',$search_values['genres']);
						break;
					
					case 'like':
						foreach($genres as $genre){
							$this->mongo_db->like('genres',$genre);
						}
						break;
				}
			}
			//Pages 
			if($search_values['pages']!=''){
				switch($where_values['pages']) {
					case 'maj':
						$this->mongo_db->where_gt('pages',(int)$search_values['pages']);
						break;
					case 'min':
						$this->mongo_db->where_lt('pages',(int)$search_values['pages']);
						break;
					case 'eql':
						$this->mongo_db->where('pages',(int)$search_values['pages']);
						break;
					case 'maj-eql':
						$this->mongo_db->where_gte('pages',(int)$search_values['pages']);
						break;
					case 'min-eql':
						$this->mongo_db->where_lte('pages',(int)$search_values['pages']);
						break;
					case 'not-eql':
						$this->mongo_db->where_ne('pages',(int)$search_values['pages']);
						break;
				}
			}
			//Vote 
			if($search_values['vote']!=0){
				switch($where_values['vote']) {
					case 'maj':
						$this->mongo_db->where_gt('vote',(int)$search_values['vote']);
						break;
					case 'min':
						$this->mongo_db->where_lt('vote',(int)$search_values['vote']);
						break;
					case 'eql':
						$this->mongo_db->where('vote',(int)$search_values['vote']);
						break;
					case 'maj-eql':
						$this->mongo_db->where_gte('vote',(int)$search_values['vote']);
						break;
					case 'min-eql':
						$this->mongo_db->where_lte('vote',(int)$search_values['vote']);
						break;
					case 'not-eql':
						$this->mongo_db->where_ne('vote',(int)$search_values['vote']);
						break;
				}
			}
			
			$books = $this->mongo_db->get('books');
		}
		
        return $books;
    }
	
	public function addBook($data) {
		
		if($this->mongo_db->switch_db('bookshelf')) {
			//Adding author
			$this->mongo_db->insert('books',$data);
			$this->mongo_db->add_index('books',array('_id' => 'ASC', 'title' => 'ASC', 'original' => 'ASC', 'author' => 'ASC', 'publisher' => 'ASC', 'genres' => 'ASC', 'pages' => 'ASC', 'vote' => 'ASC'));
		}
		
		return true;
	}
	
	public function getBookFromID($book_id)
    {		
		$book = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $book_id);
			$book = $this->mongo_db->get('books');
		}
		
        return $book;
    }
	
	public function getBookIDbyTitle($book_title) 
	{
		$return = '-1';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('title', $book_title);
			$book = $this->mongo_db->get('books');
			$return = $book[0]->_id;
		}
		
		return $return;
	}
	
	public function editBook($id, $data) {
		
		//Setting updates
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $id);
			foreach($data as $key=>$value) {
				$this->mongo_db->set($key, $value);
			}
			
			//Storing updates
			$this->mongo_db->update('books');
		}
		
		return true;
	}
	
	public function deleteBook($book_id) {

		//Removing author
		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where('_id', $book_id);
			$this->mongo_db->delete('books');
		}
		
		return true;
	}
	/*#################################*/
}