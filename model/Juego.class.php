<?php

class Juego
{
    private $id;
    private $activo;
    private $fecha_inicio;
    private $fecha_fin;
    private $familia;

    public function __construct($id, $activo, $fecha_inicio, $fecha_fin, Familia $familia)
    {
        $this->id = $id;
        $this->activo = $activo;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->familia = $familia;
    }

    //getters
    public function isActivo()
    {
        return $this->activo;
    }
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }
    public function getId()
    {
        return $this->id;
    }
}