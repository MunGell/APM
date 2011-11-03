<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Project extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
	
    
    /**
     *
     */
    public function index($project_id = 0)
    {
		if($project_id == 0)
		{
			// Show all projects of the user
		}
		else
		{
			$project = $this->doctrine->em->find('models\Project', $project_id);
		}
		
		var_dump($project);
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