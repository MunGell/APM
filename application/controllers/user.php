<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('auth', 'form_validation');
    }
	
    
    /**
     *
     */
    public function index()
    {
		echo $this->auth->getUsername();
    }
        
    /**
     * Register new user
     */
    public function register()
    {
		if($this->input->post('username'))
		{
			// This request comes from the form
			$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|xss_clean');
			if ($this->form_validation->run() != false)
			{
				// Form input is alright
			}
			else
			{
				// An error in form input
			}
		}
		else
		{
			// This request should show the registration form
		}
		
		//$this->auth->create('admin', 'munhell@gmail.com', '111');
    }
        
    /**
     * Delete a user
     */
    public function delete()
    {

    }
        
    /**
     * Edit used data
     */
    public function edit()
    {
		
    }

	/**
	 * The Login function
	 */
	public function login()
	{
		$user_name = $this->input->get('login');
		$user_pass = do_hash($this->input->get('password'), 'md5');
		if($user_name)
		{
			$this->auth->login($user_name, $user_pass, true);
		}
	}
	
	/**
	 * User logout
	 */
	public function logout()
	{
		$this->auth->logout();
	}
    
	function changePassword($user_id, $password, $new_password)
	{
		
		
	}
	
	function changeEmail($user_id, $email)
	{
		
	}

}