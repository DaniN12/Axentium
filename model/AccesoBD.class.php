
<?php

class AccesoBD
{
    const RUTA = "localhost";
    const BD = "lhizki";
    const USER = "root";
    const PASS = "123";

    public $conexion;

    function __construct()
    {
        $this->conectar();
    }

    function conectar()
    {
        $this->conexion = mysqli_connect(self::RUTA, self::USER, self::PASS, self::BD) or
            die("Error al establecer la conexión");
    }

    function cerrarConexion()
    {

        mysqli_close($this->conexion);
    }

    function lanzarSQL($SQL)
    {
        $tipoSQL = substr($SQL, 0, 6);
        if (strtoupper($tipoSQL) == "SELECT") {
            //bidireccional
            $result = mysqli_query($this->conexion, $SQL);
            return $result;
        } else {
            //unidireccional
            $result = mysqli_query($this->conexion, $SQL);
        }
    }
}
?>
