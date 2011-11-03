<?php

namespace models;

/**
 * @Entity
 * @Table(name="Link_user_types_priveleges",indexes={@index(name="link_ut_p_id_UNIQUE",columns={"link_ut_p_id"})})
 */
class LinkUserTypesPrivelege
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $link_ut_p_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $utype_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $privilege_id;


    public function __construct()
    {

    }


    public function setLinkUtPId($link_ut_p_id)
    {
        $this->link_ut_p_id = $link_ut_p_id;
        return $this; // fluent interface
    }

    public function getLinkUtPId()
    {
        return $this->link_ut_p_id;
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

    public function setPrivilegeId($privilege_id)
    {
        $this->privilege_id = $privilege_id;
        return $this; // fluent interface
    }

    public function getPrivilegeId()
    {
        return $this->privilege_id;
    }


}
