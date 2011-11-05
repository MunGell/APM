<?php

namespace models;

/**
 * @Entity
 * @Table(name="Files")
 */
class File
{
    /** 
     * @Id 
     * @Column(type="integer")
     */
    private $idFiles;


    public function __construct()
    {

    }


    public function setIdFiles($idFiles)
    {
        $this->idFiles = $idFiles;
        return $this; // fluent interface
    }

    public function getIdFiles()
    {
        return $this->idFiles;
    }


    public function setArray($array)
    {
        $this->idFiles = $array['idFiles'];
        return $this; // fluent interface
    }

    public function getArray()
    {
        return array(
            'idFiles' => $this->idFiles
        );
    }
}
