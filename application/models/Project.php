<?php

namespace models;

/**
 * @Entity
 * @Table(name="Projects")
 */
class Project
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $project_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $project_title;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $project_description;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $project_start;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $project_deadline;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $project_budget;

    /** 
     * 
     * @Column(type="boolean",nullable=true)
     */
    private $project_finish;


    public function __construct()
    {

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

    public function setProjectTitle($project_title)
    {
        $this->project_title = $project_title;
        return $this; // fluent interface
    }

    public function getProjectTitle()
    {
        return $this->project_title;
    }

    public function setProjectDescription($project_description)
    {
        $this->project_description = $project_description;
        return $this; // fluent interface
    }

    public function getProjectDescription()
    {
        return $this->project_description;
    }

    public function setProjectStart($project_start)
    {
        $this->project_start = $project_start;
        return $this; // fluent interface
    }

    public function getProjectStart()
    {
        return $this->project_start;
    }

    public function setProjectDeadline($project_deadline)
    {
        $this->project_deadline = $project_deadline;
        return $this; // fluent interface
    }

    public function getProjectDeadline()
    {
        return $this->project_deadline;
    }

    public function setProjectBudget($project_budget)
    {
        $this->project_budget = $project_budget;
        return $this; // fluent interface
    }

    public function getProjectBudget()
    {
        return $this->project_budget;
    }

    public function setProjectFinish($project_finish)
    {
        $this->project_finish = $project_finish;
        return $this; // fluent interface
    }

    public function getProjectFinish()
    {
        return $this->project_finish;
    }


    public function setArray($array)
    {
        $this->project_id = $array['project_id'];
        $this->project_title = $array['project_title'];
        $this->project_description = $array['project_description'];
        $this->project_start = $array['project_start'];
        $this->project_deadline = $array['project_deadline'];
        $this->project_budget = $array['project_budget'];
        $this->project_finish = $array['project_finish'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'project_id' => $this->project_id,
            'project_title' => $this->project_title,
            'project_description' => $this->project_description,
            'project_start' => $this->project_start,
            'project_deadline' => $this->project_deadline,
            'project_budget' => $this->project_budget,
            'project_finish' => $this->project_finish
        );
    }
}
