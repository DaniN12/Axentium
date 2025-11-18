<?php
class Notificacion
{
    private $id;
    private $texto;
    private $fecha;
    public function __construct($id = null, $texto = "", $fecha = null)
    {
        $this->id = $id;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
?>
