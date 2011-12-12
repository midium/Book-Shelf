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
		$this -> output -> enable_profiler( true );
		
		$this -> load -> library( 'form_validation' );
		$this -> form_validation -> set_error_delimiters('<span class="error">', '</span>');
		
		$this -> form_validation -> set_rules( 'username', 'Username', 'trim|required|alpha|min_length[3]|max_length[15]' );
		$this -> form_validation -> set_rules( 'password', 'Password', 'trim|required|min_length[4]|max_length[15]' );
		
		//Setting custom error messages
		$this -> form_validation -> set_message( 'min_length', 'Minimum length for %s is %s characters');
		$this -> form_validation -> set_message( 'max_length', 'Maximum length for %s is %s characters');
		
		if ( $this -> form_validation -> run() == FALSE )
		{
			$data['login_page']=true;
			loadView('main/login',$data);
        }
        else 
        {
        	//Form validation is successful, clean the input and use it.
        	//For example store in db (In this tutorial we wont use database).
        	$this -> username = $this -> security -> xss_clean( $this -> input -> post( 'username' ) );
        	$this -> password = $this -> security -> xss_clean( $this -> input -> post( 'password' ) );
        	        	
        	//Since we are not storing it to database, 
        	//lets send this data to our success view to display there.        	
        	$data['username'] = $this -> username;
        	$data['password'] = $this -> password;
			$data['login_page']=false;
        	
			$this->load->model('user', '', true);

			if ($this->user->authenticate($data['username'], $data['password']))
			{ 
				$this->session->set_userdata('loggedin', true);				
				$this->session->set_userdata('login_params',$data);
				
			} else {
				$this->session->set_userdata('message', array('title' => 'Login error', 'content' => 'Username or password doesn\'t match!', 'type' => 'loginerror' ));
			}
			
        	//load the data and success view.
			redirect('/',$data);  
        }		
    }

    function logout()
    {
		$this->session->unset_userdata('login_params');
        $this->session->unset_userdata('loggedin');
		$data['login_page']=true;
        redirect('/',$data);
    }
}