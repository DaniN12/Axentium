
<?php

class Usuario
{
    private $id;
    private $username;
    private $mail;
    private $rol;

    public function __construct($id, $username, $mail, Rol $rol)
    {
        $this->id = $id;
        $this->username = $username;
        $this->mail = $mail;
        $this->rol = $rol;
    }

    //getters
    public function getUsername()
    {
        return $this->username;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getId()
    {
        return $this->id;
    }
}
?>