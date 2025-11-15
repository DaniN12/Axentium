<?php

class Juego
{
    private $id;
    private $activo;
    private $fecha_inicio;
    private $fecha_fin;
    private $familia;
    private $preguntas = [];
    private $partidas_jugadas;

    public function __construct($id, $activo, Datetime $fecha_inicio, Datetime $fecha_fin, Familia $familia)
    {
        $this->id = $id;
        $this->activo = $activo;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->familia = $familia;
    }

    // Getters
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
    public function getFamilia()
    {
        return $this->familia;
    }
    public function setPreguntas(array $preguntas)
    {
        $this->preguntas = $preguntas;
    }
    public function getPreguntas()
    {
        return $this->preguntas;
    }
    public function addPregunta(Pregunta $pregunta)
    {
        $this->preguntas[] = $pregunta;
    }
        public function getPartidasJugadas()
    {
        return $this->partidas_jugadas;
    }
    public function setPartidasJugadas($partidas_jugadas)
    {
        $this->partidas_jugadas = $partidas_jugadas;
    }
}
