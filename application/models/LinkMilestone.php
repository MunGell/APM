<?php

namespace models;

/**
 * @Entity
 * @Table(name="Link_milestones")
 */
class LinkMilestone
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $link_mstone_id;

    /** 
     * 
     * @Column(type="integer")
     */
    private $mstone_source;

    /** 
     * 
     * @Column(type="integer")
     */
    private $mstone_target;


    public function __construct()
    {

    }


    public function setLinkMstoneId($link_mstone_id)
    {
        $this->link_mstone_id = $link_mstone_id;
        return $this; // fluent interface
    }

    public function getLinkMstoneId()
    {
        return $this->link_mstone_id;
    }

    public function setMstoneSource($mstone_source)
    {
        $this->mstone_source = $mstone_source;
        return $this; // fluent interface
    }

    public function getMstoneSource()
    {
        return $this->mstone_source;
    }

    public function setMstoneTarget($mstone_target)
    {
        $this->mstone_target = $mstone_target;
        return $this; // fluent interface
    }

    public function getMstoneTarget()
    {
        return $this->mstone_target;
    }


}
