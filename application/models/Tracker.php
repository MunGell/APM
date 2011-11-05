<?php

namespace models;

/**
 * @Entity
 * @Table(name="Trackers")
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


    public function setArray($array)
    {
        $this->track_id = $array['track_id'];
        $this->track_description = $array['track_description'];
        $this->track_start = $array['track_start'];
        $this->track_end = $array['track_end'];
        $this->user_id = $array['user_id'];
        $this->task_id = $array['task_id'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'track_id' => $this->track_id,
            'track_description' => $this->track_description,
            'track_start' => $this->track_start,
            'track_end' => $this->track_end,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id
        );
    }
}
