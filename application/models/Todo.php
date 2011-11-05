<?php

namespace models;

/**
 * @Entity
 * @Table(name="Todos")
 */
class Todo
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $todo_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $todo_title;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $todo_description;

    /** 
     * 
     * @Column(type="integer")
     */
    private $user_id;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $project_id;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $todo_start;

    /** 
     * 
     * @Column(type="datetime",nullable=true)
     */
    private $todo_deadline;

    /** 
     * 
     * @Column(type="boolean",nullable=true)
     */
    private $todo_alert;


    public function __construct()
    {

    }


    public function setTodoId($todo_id)
    {
        $this->todo_id = $todo_id;
        return $this; // fluent interface
    }

    public function getTodoId()
    {
        return $this->todo_id;
    }

    public function setTodoTitle($todo_title)
    {
        $this->todo_title = $todo_title;
        return $this; // fluent interface
    }

    public function getTodoTitle()
    {
        return $this->todo_title;
    }

    public function setTodoDescription($todo_description)
    {
        $this->todo_description = $todo_description;
        return $this; // fluent interface
    }

    public function getTodoDescription()
    {
        return $this->todo_description;
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

    public function setTodoStart($todo_start)
    {
        $this->todo_start = $todo_start;
        return $this; // fluent interface
    }

    public function getTodoStart()
    {
        return $this->todo_start;
    }

    public function setTodoDeadline($todo_deadline)
    {
        $this->todo_deadline = $todo_deadline;
        return $this; // fluent interface
    }

    public function getTodoDeadline()
    {
        return $this->todo_deadline;
    }

    public function setTodoAlert($todo_alert)
    {
        $this->todo_alert = $todo_alert;
        return $this; // fluent interface
    }

    public function getTodoAlert()
    {
        return $this->todo_alert;
    }


    public function setArray($array)
    {
        $this->todo_id = $array['todo_id'];
        $this->todo_title = $array['todo_title'];
        $this->todo_description = $array['todo_description'];
        $this->user_id = $array['user_id'];
        $this->project_id = $array['project_id'];
        $this->todo_start = $array['todo_start'];
        $this->todo_deadline = $array['todo_deadline'];
        $this->todo_alert = $array['todo_alert'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'todo_id' => $this->todo_id,
            'todo_title' => $this->todo_title,
            'todo_description' => $this->todo_description,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'todo_start' => $this->todo_start,
            'todo_deadline' => $this->todo_deadline,
            'todo_alert' => $this->todo_alert
        );
    }
}
