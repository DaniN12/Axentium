<?php
require_once(__DIR__ . "/../AccesoBD.class.php");
require_once(__DIR__ . "/../Familia.class.php");
require_once(__DIR__ . "/../Ciclo.class.php");
require_once(__DIR__ . "/../Centro.class.php");

class CentroRepository
{

    function getCentros()
    {
        $bd = new AccesoBD();
        $sql = "SELECT 
            c.id AS centroId, 
            c.nombre AS centroNombre, 
            c.localidad, 
            ci.id AS cicloId, 
            ci.nombre AS cicloNombre, 
            ci.familiaId AS familiaId
            FROM centros c
            LEFT JOIN centros_ciclos cc ON cc.centroId = c.id
            LEFT JOIN ciclos ci ON ci.id = cc.cicloId
            ;";
        $result = mysqli_query($bd->conexion, $sql);

        $centros = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $centroId = $fila['centroId'];
                $centroNombre = $fila['centroNombre'];
                $localidad = $fila['localidad'];
                $cicloId = $fila['cicloId'];
                $cicloNombre = $fila['cicloNombre'];

                if(!isset($centros[$centroId])){
                    $centros[$centroId] = new Centro($centroId, $centroNombre, $localidad,[]);
                }
                $familia = new Familia($fila['familiaId'], "");
                $ciclo = new Ciclo($cicloId, $cicloNombre, $familia);
                $centros[$centroId]->addCiclo($ciclo);
            }
            return $centros;
        }
        return null;
    }
}
