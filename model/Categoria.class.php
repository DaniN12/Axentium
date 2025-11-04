<?php

class Categoria
{
    private $id;
    private $nombre;

    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getId()
    {
        return $this->id;
    }
}
