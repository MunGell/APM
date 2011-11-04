<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index()
	{
		echo $this->twig->render('welcome_message.html', array('elapsed_time' => '123'));
	}
	
	public function test()
	{
		$user = new models\Users;
		$user->setUsername('Joseph');
		$user->setPassword('secretPassw0rd');
		$user->setGroup(2);

		$this->doctrine->em->persist($user);
		$this->doctrine->em->flush();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */