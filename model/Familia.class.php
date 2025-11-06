
<?php

class Familia
{
    private $id;
    private $nombre;

    public function __construct($id, $nombre=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    //getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getId()
    {
        return $this->id;
    }
}
?>