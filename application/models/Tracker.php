<?php

namespace models;

/**
 * @Entity
 * @Table(name="Trackers",indexes={@index(name="track_id_UNIQUE",columns={"track_id"})})
 */
class Tracker
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $track_id;

    /** 
     * 
     * @Column(type="text",nullable=true)
     */
    private $track_description;

    /** 
     * 
     * @Column(type="datetime")
     */
    private $track_start;

    /** 
     * 
     * @Column(type="datetime")
     */
    private $track_end;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $user_id;

    /** 
     * 
     * @Column(type="integer",nullable=true)
     */
    private $task_id;


    public function __construct()
    {

    }


    public function setTrackId($track_id)
    {
        $this->track_id = $track_id;
        return $this; // fluent interface
    }

    public function getTrackId()
    {
        return $this->track_id;
    }

    public function setTrackDescription($track_description)
    {
        $this->track_description = $track_description;
        return $this; // fluent interface
    }

    public function getTrackDescription()
    {
        return $this->track_description;
    }

    public function setTrackStart($track_start)
    {
        $this->track_start = $track_start;
        return $this; // fluent interface
    }

    public function getTrackStart()
    {
        return $this->track_start;
    }

    public function setTrackEnd($track_end)
    {
        $this->track_end = $track_end;
        return $this; // fluent interface
    }

    public function getTrackEnd()
    {
        return $this->track_end;
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

    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
        return $this; // fluent interface
    }

    public function getTaskId()
    {
        return $this->task_id;
    }


}
