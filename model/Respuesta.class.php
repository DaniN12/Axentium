<?php

class Respuesta
{
    private $usuario;
    private $juego;
    private $pregunta;
    private $respuestaSeleccionada;

    public function __construct(Usuario $usuario, Juego $juego, Pregunta $pregunta, ?int $respuestaSeleccionada = null)
    {
        $this->usuario = $usuario;
        $this->juego = $juego;
        $this->pregunta = $pregunta;
        $this->respuestaSeleccionada = $respuestaSeleccionada;
    }

    // Getters
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getJuego()
    {
        return $this->juego;
    }

    public function getPregunta()
    {
        return $this->pregunta;
    }

    public function getRespuestaSeleccionada()
    {
        return $this->respuestaSeleccionada;
    }
}
