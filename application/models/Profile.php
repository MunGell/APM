<?php

namespace models;

/**
 * @Entity
 * @Table(name="Profiles",indexes={@index(name="profile_id_UNIQUE",columns={"profile_id"})})
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


}
