
<?php

class Rol
{
    private $id;
    private $rol;

    public function __construct($rol, $id)
    {
        $this->rol = $rol;
        $this->id = $id;
    }

    //getters
    public function getRolId()
    {
        return $this->id;
    }
    public function getRolName()
    {
        return $this->rol;
    }
}
?>
