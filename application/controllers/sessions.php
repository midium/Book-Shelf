<?php

class Sessions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
		$this->load->helper('logic');

    }

    function login()
    { 
		$data['login_page']=true;
		loadView('main/login',$data);	
    }
	
	function forgot()
	{
		$data['login_page']=false;

		loadView('main/under_construction',$data);		

	}

    function authenticate()
    {
        $this->load->model('user', '', true);

        $user = $this->input->post('user');

        if ($this->user->authenticate($user['email'], $user['password']))
        {
            $this->session->set_userdata('loggedin', true);
        }

        redirect('/');
    }

    function logout()
    {
        $this->session->unset_userdata('loggedin');

        redirect('/');
    }
}