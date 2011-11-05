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
		if (!in_array('user_controller_lang.php', $this->lang->is_loaded, TRUE))
		{
			$this->lang->load('user_controller');
		}
    }
	
    
    /**
     * Current user profile page
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
     * Register a new user
     */
    public function register()
    {
		if($this->input->post('username'))
		{
			// This request comes from the form
			$this->form_validation->set_rules('username', 'username', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'required|matches[password_confirmation]|xss_clean');
			if ($this->form_validation->run() != false)
			{
				// Form input is alright
				$username	= $this->input->post('username');
				$email		= $this->input->post('email');
				$password	= do_hash($this->input->post('password'), 'md5');
				$regStatus = $this->auth->createUser($username, $email, $password);
				if($regStatus === true)
				{
					// Registration successful
					echo $this->twig->render('login_form.html', array(
						'title'			=> $this->_translation('login_title'),
						'csrf_variable' => $this->security->get_csrf_token_name(),
						'csrf_value'	=> $this->security->get_csrf_hash(),
						'message'		=> $this->_translation('registered')
						));
				}
				else
				{
					// An error occured during registration process
					echo $this->twig->render('registration_form.html', array(
						'title'			=> $this->_translation('registration_title'),
						'csrf_variable' => $this->security->get_csrf_token_name(),
						'csrf_value'	=> $this->security->get_csrf_hash(),
						'error'			=> $regStatus
						));
				}
			}
			else
			{
				// An error in form input
				echo $this->twig->render('registration_form.html', array(
					'title'			=> $this->_translation('registration_title'),
					'csrf_variable' => $this->security->get_csrf_token_name(),
					'csrf_value'	=> $this->security->get_csrf_hash(),
					'error'			=> validation_errors()
					));
			}
		}
		else
		{
			// This request should show the registration form
			echo $this->twig->render('registration_form.html', array(
				'title'			=> $this->_translation('registration_title'),
				'csrf_variable' => $this->security->get_csrf_token_name(),
				'csrf_value'	=> $this->security->get_csrf_hash()
				));
		}
    }
        
    /**
     * Delete a user
     */
    public function delete()
    {
		// ToDo;
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
	 * A user login 
	 */
	public function login()
	{
		// ToDo: create remeber checkbox
		if($this->auth->isLoggedIn())
		{
			redirect('/user', 'location');
		}
		if($this->input->post('username'))
		{
			// Process the login data
			$this->form_validation->set_rules('username', $this->_translation('username'), 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('password', $this->_translation('password'), 'required|xss_clean');
			if ($this->form_validation->run() != false)
			{
				$user_name = $this->input->post('username');
				$user_pass = do_hash($this->input->post('password'), 'md5');
				if($user_name)
				{
					$loginStatus = $this->auth->login($user_name, $user_pass, true);
					if($loginStatus === true)
					{
						redirect('/', 'location');
					}
					else
					{
						// Show error page
						echo $this->twig->render('login_form.html', array(
							'title'			=> $this->_translation('login_title'),
							'csrf_variable' => $this->security->get_csrf_token_name(),
							'csrf_value'	=> $this->security->get_csrf_hash(),
							'error'			=> $loginStatus
							));
					}
				}
			}
			else
			{
				// Show an error about incorrect form input
				echo $this->twig->render('login_form.html', array(
					'title'			=> $this->_translation('login_title'),
					'csrf_variable' => $this->security->get_csrf_token_name(),
					'csrf_value'	=> $this->security->get_csrf_hash(),
					'error'			=> validation_errors(' ',' ')
					));
			}
		}
		else
		{
			// Show the login form
			echo $this->twig->render('login_form.html', array(
				'title' => $this->_translation('login_title'),
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
    
	/**
	 * Change user password
	 */
	public function changePassword($user_id, $password, $new_password)
	{
		// ToDo;
	}
	
	/**
	 * Change user email
	 */
	public function changeEmail($user_id, $email)
	{
		// ToDo;
		// ToDo: deactivate user when email changed
	}
	
	/**
	 * Internal translation function
	 */
	private function _translation($line, $values = array())
	{
		if($count = count($values) > 0)
		{
			$line = $this->lang->language[$line];
			for($i = 0; $i < $count; $i++)
			{
				$line = str_replace('%'.($i+1), $values[$i], $line);
			}
			return $line;
		}
		else
		{
			return $this->lang->language[$line];
		}
	}

}