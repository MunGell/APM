<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('auth');
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
		if($user_name && $user_pass)
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