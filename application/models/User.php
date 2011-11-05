<?php

namespace models;

/**
 * @Entity
 * @Table(name="Users")
 */
class User
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $user_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $user_name;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $user_email;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $user_pass;

    /** 
     * 
     * @Column(type="integer")
     */
    private $user_type;

    /** 
     * 
     * @Column(type="boolean")
     */
    private $user_active;

    /** 
     * 
     * @Column(type="datetime")
     */
    private $user_created_at;

    /** 
     * 
     * @Column(type="datetime")
     */
    private $user_last_login;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $user_activation_key;


    public function __construct()
    {

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

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
        return $this; // fluent interface
    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
        return $this; // fluent interface
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserPass($user_pass)
    {
        $this->user_pass = $user_pass;
        return $this; // fluent interface
    }

    public function getUserPass()
    {
        return $this->user_pass;
    }

    public function setUserType($user_type)
    {
        $this->user_type = $user_type;
        return $this; // fluent interface
    }

    public function getUserType()
    {
        return $this->user_type;
    }

    public function setUserActive($user_active)
    {
        $this->user_active = $user_active;
        return $this; // fluent interface
    }

    public function getUserActive()
    {
        return $this->user_active;
    }

    public function setUserCreatedAt($user_created_at)
    {
        $this->user_created_at = $user_created_at;
        return $this; // fluent interface
    }

    public function getUserCreatedAt()
    {
        return $this->user_created_at;
    }

    public function setUserLastLogin($user_last_login)
    {
        $this->user_last_login = $user_last_login;
        return $this; // fluent interface
    }

    public function getUserLastLogin()
    {
        return $this->user_last_login;
    }

    public function setUserActivationKey($user_activation_key)
    {
        $this->user_activation_key = $user_activation_key;
        return $this; // fluent interface
    }

    public function getUserActivationKey()
    {
        return $this->user_activation_key;
    }


    public function setArray($array)
    {
        $this->user_id = $array['user_id'];
        $this->user_name = $array['user_name'];
        $this->user_email = $array['user_email'];
        $this->user_pass = $array['user_pass'];
        $this->user_type = $array['user_type'];
        $this->user_active = $array['user_active'];
        $this->user_created_at = $array['user_created_at'];
        $this->user_last_login = $array['user_last_login'];
        $this->user_activation_key = $array['user_activation_key'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_pass' => $this->user_pass,
            'user_type' => $this->user_type,
            'user_active' => $this->user_active,
            'user_created_at' => $this->user_created_at,
            'user_last_login' => $this->user_last_login,
            'user_activation_key' => $this->user_activation_key
        );
    }
}
