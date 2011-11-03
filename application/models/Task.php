<?php

namespace models;

/**
 * @Entity
 * @Table(name="Tasks",indexes={@index(name="task_id_UNIQUE",columns={"task_id"})})
 */
class Task
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $task_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $task_title;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $task_description;

    /** 
     * 
     * @Column(type="integer")
     */
    private $tlist_id;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $task_user_source;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $task_user_target;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $task_start;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $task_deadline;

	/** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $task_priority;

    /** 
     * 
     * @Column(type="boolean",nullable=true)
     */
    private $task_finish;


    public function __construct()
    {

    }


    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
        return $this; // fluent interface
    }

    public function getTaskId()
    {
        return $this->task_id;
    }

    public function setTaskTitle($task_title)
    {
        $this->task_title = $task_title;
        return $this; // fluent interface
    }

    public function getTaskTitle()
    {
        return $this->task_title;
    }

    public function setTaskDescription($task_description)
    {
        $this->task_description = $task_description;
        return $this; // fluent interface
    }

    public function getTaskDescription()
    {
        return $this->task_description;
    }

    public function setTlistId($tlist_id)
    {
        $this->tlist_id = $tlist_id;
        return $this; // fluent interface
    }

    public function getTlistId()
    {
        return $this->tlist_id;
    }

    public function setTaskUserSource($task_user_source)
    {
        $this->task_user_source = $task_user_source;
        return $this; // fluent interface
    }

    public function getTaskUserSource()
    {
        return $this->task_user_source;
    }

    public function setTaskUserTarget($task_user_target)
    {
        $this->task_user_target = $task_user_target;
        return $this; // fluent interface
    }

    public function getTaskUserTarget()
    {
        return $this->task_user_target;
    }

    public function setTaskStart($task_start)
    {
        $this->task_start = $task_start;
        return $this; // fluent interface
    }

    public function getTaskStart()
    {
        return $this->task_start;
    }

    public function setTaskDeadline($task_deadline)
    {
        $this->task_deadline = $task_deadline;
        return $this; // fluent interface
    }

    public function getTaskDeadline()
    {
        return $this->task_deadline;
    }

    public function setTaskPriority($task_priority)
    {
        $this->task_priority = $task_priority;
        return $this; // fluent interface
    }

    public function getTaskPriority()
    {
        return $this->task_priority;
    }

    public function setTaskFinish($task_finish)
    {
        $this->task_finish = $task_finish;
        return $this; // fluent interface
    }

    public function getTaskFinish()
    {
        return $this->task_finish;
    }

}
