
<?php

class Usuario
{
    private $id;
    private $username;
    private $mail;
    private $rol;
    private $ciclo;
    private $centro; 

    public function __construct($id, $username, $mail, Rol $rol, Ciclo $ciclo, Centro $centro)
    {
        $this->id = $id;
        $this->username = $username;
        $this->mail = $mail;
        $this->rol = $rol;
        $this->ciclo = $ciclo;
        $this->centro = $centro;
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
    public function getCiclo()
    {
        return $this->ciclo;
    }
    public function getCentro()
    {
        return $this->centro;
    }
}
?>