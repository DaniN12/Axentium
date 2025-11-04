<?php

class Partida {
    private $usuario;
    private $juego;
    private $puntuacion;
    private $fecha;

     public function __construct(Usuario $usuario, Juego $juego, $puntuacion, DateTime $fecha)
    {
        $this->usuario = $usuario;
        $this->juego = $juego;
        $this->puntuacion = $puntuacion;
        $this->fecha = $fecha;
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

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
}


?>