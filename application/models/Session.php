<?php

namespace models;

/**
 * @Entity
 * @Table(name="Sessions",indexes={@index(name="last_activity_idx",columns={"last_activity"})})
 */
class Session
{
    /** 
     * @Id 
     * @Column(type="string",length=40)
     */
    private $session_id;

    /** 
     * 
     * @Column(type="string",length=16)
     */
    private $ip_address;

    /** 
     * 
     * @Column(type="string",length=120)
     */
    private $user_agent;

    /** 
     * 
     * @Column(type="integer")
     */
    private $last_activity;

    /** 
     * 
     * @Column(type="text")
     */
    private $user_data;


    public function __construct()
    {

    }


    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
        return $this; // fluent interface
    }

    public function getSessionId()
    {
        return $this->session_id;
    }

    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
        return $this; // fluent interface
    }

    public function getIpAddress()
    {
        return $this->ip_address;
    }

    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
        return $this; // fluent interface
    }

    public function getUserAgent()
    {
        return $this->user_agent;
    }

    public function setLastActivity($last_activity)
    {
        $this->last_activity = $last_activity;
        return $this; // fluent interface
    }

    public function getLastActivity()
    {
        return $this->last_activity;
    }

    public function setUserData($user_data)
    {
        $this->user_data = $user_data;
        return $this; // fluent interface
    }

    public function getUserData()
    {
        return $this->user_data;
    }


}
