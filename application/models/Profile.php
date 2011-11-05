<?php

namespace models;

/**
 * @Entity
 * @Table(name="Profiles")
 */
class Profile
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $profile_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $user_id;


    public function __construct()
    {

    }


    public function setProfileId($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this; // fluent interface
    }

    public function getProfileId()
    {
        return $this->profile_id;
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


    public function setArray($array)
    {
        $this->profile_id = $array['profile_id'];
        $this->user_id = $array['user_id'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'profile_id' => $this->profile_id,
            'user_id' => $this->user_id
        );
    }
}
