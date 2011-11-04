<?php

namespace models;

/**
 * @Entity
 * @Table(name="Project_managers")
 */
class ProjectManager
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $pmanager_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $user_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $project_id;

    /** 
     * 
     * @Column(type="boolean")
     */
    private $pmanager_leader;


    public function __construct()
    {

    }


    public function setPmanagerId($pmanager_id)
    {
        $this->pmanager_id = $pmanager_id;
        return $this; // fluent interface
    }

    public function getPmanagerId()
    {
        return $this->pmanager_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this; // fluent interface
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
        return $this; // fluent interface
    }

    public function getProjectId()
    {
        return $this->project_id;
    }

    public function setPmanagerLeader($pmanager_leader)
    {
        $this->pmanager_leader = $pmanager_leader;
        return $this; // fluent interface
    }

    public function getPmanagerLeader()
    {
        return $this->pmanager_leader;
    }


}
