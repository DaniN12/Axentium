<?php
require_once(__DIR__."/../AccesoBD.class.php");
require_once(__DIR__."/../Centro.class.php");

class CentroRepository
{

    function getCentros()
    {
        $bd = new AccesoBD();
        $sql = "SELECT id, nombre, localidad
            FROM centros;";
        $result = mysqli_query($bd->conexion, $sql);

        $centros = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $localidad = $fila['localidad'];

                $centros[] = new Centro($id, $nombre, $localidad);
            }
            return $centros;
        }
        return null;
    }
}