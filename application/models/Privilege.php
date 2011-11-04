<?php

namespace models;

/**
 * @Entity
 * @Table(name="Privileges")
 */
class Privilege
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $privilege_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $privilege_title;


    public function __construct()
    {

    }


    public function setPrivilegeId($privilege_id)
    {
        $this->privilege_id = $privilege_id;
        return $this; // fluent interface
    }

    public function getPrivilegeId()
    {
        return $this->privilege_id;
    }

    public function setPrivilegeTitle($privilege_title)
    {
        $this->privilege_title = $privilege_title;
        return $this; // fluent interface
    }

    public function getPrivilegeTitle()
    {
        return $this->privilege_title;
    }


}
