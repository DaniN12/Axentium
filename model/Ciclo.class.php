
<?php
require_once(__DIR__ . '/./Familia.class.php');

class Ciclo
{
    private $id;
    private $nombre;
    private $familia;

    public function __construct($id, $nombre, Familia $familia)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->familia = $familia;
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
    public function getFamilia()
    {
        return $this->familia;
    }
}
?>
