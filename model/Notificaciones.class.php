<?php
class Notificacion
{
    private $id;
    private $texto;

    public function __construct($id = null, $texto = "")
    {
        $this->id = $id;
        $this->texto = $texto;
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
}
?>
