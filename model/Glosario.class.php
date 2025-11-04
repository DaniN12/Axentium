<?php
class Glosario {
    public $id;
    public $palabra_euskera;
    public $palabra_castellano;

    public function __construct($id, $palabra_euskera, $palabra_castellano) {
        $this->id = $id;
        $this->palabra_euskera = $palabra_euskera;
        $this->palabra_castellano = $palabra_castellano;
    }
}
?>
