<?php

class Mongo_Manage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
	}
	
    public function getAuthorsList()
    {		
		$this->load->library('Mongo_db');

		$authors = '';
		
		if($this->mongo_db->switch_db('bookshelf')) {
			$authors = $this->mongo_db->get('authors');
		}

        return $authors;
    }
}