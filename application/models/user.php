<?php

class User extends CI_Model
{
    public function authenticate($user, $password)
    {
		$this->load->library('Mongo_db');

		if($this->mongo_db->switch_db('bookshelf')) {
			$this->mongo_db->where(array('_id' => $user));
			$user_pass = $this->mongo_db->get_no_automatic_id('users');

			if (isset($user_pass)){
				if($user_pass[0]->password==$password){
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
	
		}

        return false;
    }
}