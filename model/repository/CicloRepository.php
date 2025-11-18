
<?php
require_once(__DIR__."/../Familia.class.php");
require_once(__DIR__."/../Ciclo.class.php");

class CicloRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function getCiclos()
    {
        $sql = "SELECT ciclos.id, ciclos.nombre, familiaId, familias.nombre AS familia
            FROM ciclos
            INNER JOIN familias ON ciclos.familiaId=familias.id 
            ;";
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
}
?>
