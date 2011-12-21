<?php

class Mongo_Manage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('Mongo_db');
	}
	
    public function getAuthorsList()
    {		
		$authors = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$authors = $this->mongo_db->get('authors');
		}

        return $authors;
    }
	
	public function addAuthor($author, $nationality) {
		
		$author_data = array('name' => $author,
							 'nationality' => $nationality);

		//Adding author
		$this->mongo_db->insert('authors',$author_data);
		$this->mongo_db->add_index('authors',array('_id' => 'ASC', 'name' => 'ASC', 'nationality' => 'ASC'));		
		
		return true;
	}
	
	public function deleteAuthor($author_id) {

		//Removing author
		$this->mongo_db->delete_id('authors',$author_id);
		
		return true;
	}
	
	public function editAuthor($id, $author, $nationality) {
		
		//Setting updates
		$this->mongo_db->where('_id', $id);
		$this->mongo_db->set('name', $author);
		$this->mongo_db->set('nationality', $nationality);
		
		//Storing updates
		$this->mongo_db->update('authors');
		$this->mongo_db->add_index('authors',array('_id' => 'ASC', 'name' => 'ASC', 'nationality' => 'ASC'));		
		
		return true;
	}
}