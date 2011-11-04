<?php

namespace models;

/**
 * @Entity
 * @Table(name="Milestones")
 */
class Milestone
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $mstone_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $mstone_title;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $mstone_description;

    /** 
     * 
     * @Column(type="integer")
     */
    private $project_id;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $mstone_start;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $mstone_deadline;

    /** 
     * 
     * @Column(type="boolean",nullable=true)
     */
    private $mstone_finish;


    public function __construct()
    {

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

    public function setMstoneTitle($mstone_title)
    {
        $this->mstone_title = $mstone_title;
        return $this; // fluent interface
    }

    public function getMstoneTitle()
    {
        return $this->mstone_title;
    }

    public function setMstoneDescription($mstone_description)
    {
        $this->mstone_description = $mstone_description;
        return $this; // fluent interface
    }

    public function getMstoneDescription()
    {
        return $this->mstone_description;
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

    public function setMstoneStart($mstone_start)
    {
        $this->mstone_start = $mstone_start;
        return $this; // fluent interface
    }

    public function getMstoneStart()
    {
        return $this->mstone_start;
    }

    public function setMstoneDeadline($mstone_deadline)
    {
        $this->mstone_deadline = $mstone_deadline;
        return $this; // fluent interface
    }

    public function getMstoneDeadline()
    {
        return $this->mstone_deadline;
    }

    public function setMstoneFinish($mstone_finish)
    {
        $this->mstone_finish = $mstone_finish;
        return $this; // fluent interface
    }

    public function getMstoneFinish()
    {
        return $this->mstone_finish;
    }


}
