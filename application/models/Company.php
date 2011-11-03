<?php

namespace models;

/**
 * @Entity
 * @Table(name="Companies")
 */
class Company
{
    /** 
     * @Id 
     * @Column(type="integer")
     */
    private $idCompanies;


    public function __construct()
    {

    }


    public function setIdCompanies($idCompanies)
    {
        $this->idCompanies = $idCompanies;
        return $this; // fluent interface
    }

    public function getIdCompanies()
    {
        return $this->idCompanies;
    }


}
