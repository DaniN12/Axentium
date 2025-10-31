<?php

class Pregunta
{
    private $id;
    private $pregunta;
    private $opcion1;
    private $opcion2;
    private $opcion3;
    private $correcta;
    private $usada;
    private $img;
    private $familia;
    private $categoria;

    public function __construct($id, $pregunta, $opcion1, $opcion2, $opcion3, $correcta, $usada, $img, Familia $familia, Categoria $categoria)
    {
        $this->id = $id;
        $this->pregunta = $pregunta;
        $this->opcion1 = $opcion1;
        $this->opcion2 = $opcion2;
        $this->opcion3 = $opcion3;
        $this->correcta = $correcta;
        $this->usada = $usada;
        $this->img = $img;
        $this->familia = $familia;
        $this->categoria = $categoria;
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getPregunta()
    {
        return $this->pregunta;
    }

    public function getOpcion1()
    {
        return $this->opcion1;
    }

    public function getOpcion2()
    {
        return $this->opcion2;
    }

    public function getOpcion3()
    {
        return $this->opcion3;
    }

    public function getCorrecta()
    {
        return $this->correcta;
    }

    public function getUsada()
    {
        return $this->usada;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getFamilia()
    {
        return $this->familia;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

}