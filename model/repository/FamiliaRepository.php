<?php
require_once(__DIR__ . "/../Familia.class.php");
require_once(__DIR__ . "/../Ciclo.class.php");

class FamiliaRepository
{
        private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function getFamilias()
    {
        $sql = "SELECT id, nombre
            FROM familias
            ;";
        $result = mysqli_query($this->conexion, $sql);

        $familias = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $familias[] = new Familia($id, $nombre);
            }
            return $familias;
        }
        return null;
    }

    function getFamiliasByCentro($centro) //REVISAR 
    {
        $sql = "SELECT centros.id, centros.nombre, familias.id, nombre
            FROM familias
            WHERE 
            ;";
        $result = mysqli_query($this->conexion, $sql);

        $familias = [];

        if ($result) { //Revisar
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $familias[] = new Familia($id, $nombre);
            }
            return $familias;
        }
        return null;
    }
}
