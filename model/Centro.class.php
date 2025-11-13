
<?php

class Centro
{
    private $id;
    private $nombre;
    private $localidad;
    private $ciclos;

    public function __construct($id, $nombre, $localidad=null, array $ciclos=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->localidad = $localidad;
        $this->ciclos = $ciclos;
    }

    //getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getLocalidad()
    {
        return $this->localidad;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getCiclos()
    {
        return $this->ciclos;
    }
    public function addCiclo(Ciclo $ciclo)
    {
        $this->ciclos[] = $ciclo;
    }
    public function removeCiclo(Ciclo $ciclo)
    {
        foreach ($this->ciclos as $index => $cicloActual) {
            if ($cicloActual->getId() === $ciclo->getId()) {
                unset($this->ciclos[$index]);
                $this->ciclos = array_values($this->ciclos);
            }
        }
    }
}
?>
