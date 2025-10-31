<?php

class Centro
{
    private $id;
    private $nombre;
    private $localidad;

    public function __construct($id, $nombre, $localidad)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->localidad = $localidad;
    }

    //getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getLocalidad()
    {
        return $this->localidad;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
}