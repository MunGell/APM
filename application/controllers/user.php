<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
    
    /**
     *
     */
    public function index()
    {
		if(!$this->auth->isLoggedIn())
		{
			redirect('/user/login', 'location');
		}
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
			$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirmation]|xss_clean');
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
		if($this->auth->isLoggedIn())
		{
			redirect('/user', 'location');
		}
		if($this->input->post('login'))
		{
			// Process the login data
			$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			if ($this->form_validation->run() != false)
			{
				$user_name = $this->input->post('login');
				$user_pass = do_hash($this->input->post('password'), 'md5');
				if($user_name)
				{
					if($this->auth->login($user_name, $user_pass, true))
					{
						redirect('/', 'location');
					}
					else
					{
						// Show error page
					}
				}
			}
			else
			{
				// Show an error about incorrect form input
				echo $this->twig->render('login_form.html', array(
					'title'			=> 'Login form',
					'csrf_variable' => $this->security->get_csrf_token_name(),
					'csrf_value'	=> $this->security->get_csrf_hash(),
					'error'			=> validation_errors()
					));
			}
		}
		else
		{
			// Show the login form
			echo $this->twig->render('login_form.html', array(
				'title' => 'Login form',
				'csrf_variable'	=> $this->security->get_csrf_token_name(),
				'csrf_value'	=> $this->security->get_csrf_hash()
				));
		}
	}
	
	/**
	 * User logout
	 */
	public function logout()
	{
		$this->auth->logout();
		redirect('/', 'location');
	}
    
	public function changePassword($user_id, $password, $new_password)
	{
		
		
	}
	
	public function changeEmail($user_id, $email)
	{
		
	}

}