<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller {

	private $mydb;

    public function __construct()
    {
        parent::__construct();
		if(!$this->auth->isLoggedIn())
		{
			redirect('/user/login');
		}
		if (!in_array('dashboard_lang.php', $this->lang->is_loaded, TRUE))
		{
			$this->lang->load('dashboard');
		}
		$this->mydb = $this->doctrine->em;
    }
	
    
    /**
     *
     */
    public function index()
    {
		echo $this->twig->render('dashboard.html', array(
			'title'			=> translate('dashboard_title')
			));
    }
     

}