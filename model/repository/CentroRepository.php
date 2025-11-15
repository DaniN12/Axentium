
<?php
require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Ciclo.class.php");
require_once(BASE_PATH . "/model/Centro.class.php");

class CentroRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function getCentros()
    {
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
        $result = mysqli_query($this->conexion, $sql);

        $centros = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $centroId = $fila['centroId'];
                $centroNombre = $fila['centroNombre'];
                $localidad = $fila['localidad'];
                $cicloId = $fila['cicloId'];
                $cicloNombre = $fila['cicloNombre'];

                if (!isset($centros[$centroId])) {
                    $centros[$centroId] = new Centro($centroId, $centroNombre, $localidad, []);
                }
                $familia = new Familia($fila['familiaId'], "");
                $ciclo = new Ciclo($cicloId, $cicloNombre, $familia);
                $centros[$centroId]->addCiclo($ciclo);
            }
            return $centros;
        }
        return null;
    }

    function getCiclosByCentroId($centroId)
    {
        $sql = "SELECT c.id, c.nombre, c.familiaId, f.nombre AS familia
            FROM ciclos c
            INNER JOIN centros_ciclos cc ON cc.cicloId = c.id 
            INNER JOIN familias f ON f.id = c.familiaId
            WHERE centroId = $centroId;
        ";
        $result = mysqli_query($this->conexion, $sql);

        $ciclos = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $familia = new Familia($fila['familiaId'], $fila['familia']);
                $ciclos[] = new Ciclo($id, $nombre, $familia);
            }
            return $ciclos;
        }
        return null;
    }

    function getFamiliasByCentroId($centroId)
    {
        $sql = "SELECT DISTINCT c.familiaId, f.nombre
            FROM ciclos c
            INNER JOIN centros_ciclos cc ON cc.cicloId = c.id 
            INNER JOIN familias f ON f.id = c.familiaId
            WHERE centroId = $centroId;
        ";
        $result = mysqli_query($this->conexion, $sql);

        $familias = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['familiaId'];
                $nombre = $fila['nombre'];
                $familias[] = new Familia($id, $nombre);
            }
            return $familias;
        }
        return null;
    }
}
?>
