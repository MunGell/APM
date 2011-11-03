<?php

namespace models;

/**
 * @Entity
 * @Table(name="User_types",indexes={@index(name="utype_id_UNIQUE",columns={"utype_id"})})
 */
class UserType
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $utype_id;

    /** 
     * 
     * @Column(type="string",length=100)
     */
    private $utype_title;


    public function __construct()
    {

    }


    public function setUtypeId($utype_id)
    {
        $this->utype_id = $utype_id;
        return $this; // fluent interface
    }

    public function getUtypeId()
    {
        return $this->utype_id;
    }

    public function setUtypeTitle($utype_title)
    {
        $this->utype_title = $utype_title;
        return $this; // fluent interface
    }

    public function getUtypeTitle()
    {
        return $this->utype_title;
    }


}
