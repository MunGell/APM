<?php

namespace models;

/**
 * @Entity
 * @Table(name="Task_lists")
 */
class TaskList
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $tlists_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $tlist_title;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $tlist_description;

    /** 
     * 
     * @Column(type="integer")
     */
    private $project_id;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $mstone_id;


    public function __construct()
    {

    }


    public function setTlistsId($tlists_id)
    {
        $this->tlists_id = $tlists_id;
        return $this; // fluent interface
    }

    public function getTlistsId()
    {
        return $this->tlists_id;
    }

    public function setTlistTitle($tlist_title)
    {
        $this->tlist_title = $tlist_title;
        return $this; // fluent interface
    }

    public function getTlistTitle()
    {
        return $this->tlist_title;
    }

    public function setTlistDescription($tlist_description)
    {
        $this->tlist_description = $tlist_description;
        return $this; // fluent interface
    }

    public function getTlistDescription()
    {
        return $this->tlist_description;
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

    public function setMstoneId($mstone_id)
    {
        $this->mstone_id = $mstone_id;
        return $this; // fluent interface
    }

    public function getMstoneId()
    {
        return $this->mstone_id;
    }


}
