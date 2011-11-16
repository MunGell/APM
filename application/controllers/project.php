<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Project extends CI_Controller {

	private $mydb;
	
    public function __construct()
    {
        parent::__construct();
		if(!$this->auth->isLoggedIn())
		{
			redirect('/user/login');
		}
		$this->mydb = $this->doctrine->em;
    }
	
    
    /**
     *
     */
    public function show($project_id = 0)
    {
		if($project_id == 0)
		{
			// Show all projects of the user
			echo 1;
		}
		else
		{
			$project = $this->mydb->find('models\Project', $project_id);
			echo $project->getProjectTitle();
		}
    }
        
    /**
     *
     */
    public function create()
    {

    }
        
    /**
     *
     */
    public function delete()
    {

    }
        
    /**
     *
     */
    public function update()
    {

    }
     

}