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
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			if ($this->form_validation->run() != false)
			{
				// Form input is alright
				$username	= $this->input->post('username');
				$email		= $this->input->post('email');
				$password	= $this->input->post('password');
				if($this->auth->createUser($username, $email, $password))
				{
					// Registration successful
				}
				else
				{
					// An error occured during registration process
				}
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
    }
        
    /**
     * Delete a user
     */
    public function delete()
    {
		$this->auth->deleteUser($this->input->post('id'));
		// Show ondeletion message
    }
        
    /**
     * Edit user data
     */
    public function edit()
    {
		//var_dump($this->auth->getAllData());
    }

	/**
	 * The Login function
	 */
	public function login()
	{
		// ToDo: change to POST data
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
    
	public function changePassword($user_id, $password, $new_password)
	{
		
		
	}
	
	public function changeEmail($user_id, $email)
	{
		
	}

}