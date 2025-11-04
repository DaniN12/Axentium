<?php
require_once(__DIR__ . "/../AccesoBD.class.php");
require_once(__DIR__ . "/../Familia.class.php");
require_once(__DIR__ . "/../Ciclo.class.php");

class FamiliasRepository
{

    function getFamilias()
    {
        $bd = new AccesoBD();
        $sql = "SELECT id, nombre
            FROM familias
            ;";
        $result = mysqli_query($bd->conexion, $sql);

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

    function getFamiliasByCentro($centro) //REVISAR ESTÁ TODO PENDIENTE
    {
        $bd = new AccesoBD();
        $sql = "SELECT centros.id, centros.nombre, familias.id, nombre
            FROM familias
            WHERE 
            ;";
        $result = mysqli_query($bd->conexion, $sql);

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
