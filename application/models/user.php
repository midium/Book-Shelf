<?php

class User extends CI_Model
{
    public function authenticate($user, $password)
    {
		$this->load->library('Mongo_db');

log_message('info','loaded mongo library');

log_message('info','trying to switch to bookshelf db');
		if($this->mongo_db->switch_db('bookshelf')) {
			log_message('info','trying to perform a get_where');
			$user_pass = $this->mongo_db->get_where('users',array('_id' => $user));
			
			log_message('debug','get_where result: '.$user_pass);

			if (isset($user_pass)){
				if($user_pass==$password){
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