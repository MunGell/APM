<?php

namespace models;

/**
 * @Entity
 * @Table(name="Link_tasks")
 */
class LinkTask
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $link_task_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $task_source;

    /** 
     * 
     * @Column(type="integer")
     */
    private $task_target;


    public function __construct()
    {

    }


    public function setLinkTaskId($link_task_id)
    {
        $this->link_task_id = $link_task_id;
        return $this; // fluent interface
    }

    public function getLinkTaskId()
    {
        return $this->link_task_id;
    }

    public function setTaskSource($task_source)
    {
        $this->task_source = $task_source;
        return $this; // fluent interface
    }

    public function getTaskSource()
    {
        return $this->task_source;
    }

    public function setTaskTarget($task_target)
    {
        $this->task_target = $task_target;
        return $this; // fluent interface
    }

    public function getTaskTarget()
    {
        return $this->task_target;
    }


}
