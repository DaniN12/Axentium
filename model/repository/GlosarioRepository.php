<?php
require_once(__DIR__ . '/../Glosario.class.php');

class GlosarioRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Obtener todas las palabras
    public function obtenerTodos()
    {
        $sql = "SELECT * FROM glosario ORDER BY palabra_euskera ASC";
        $result = mysqli_query($this->conexion, $sql);

        $palabras = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $palabras[] = new Glosario($row['id'], $row['palabra_euskera'], $row['palabra_castellano']);
        }
        return $palabras;
    }

    // Agregar una palabra
    public function agregar($euskera, $castellano)
    {
        $euskera = mysqli_real_escape_string($this->conexion, $euskera);
        $castellano = mysqli_real_escape_string($this->conexion, $castellano);
        $sql = "INSERT INTO glosario (palabra_euskera, palabra_castellano)
                VALUES ('$euskera', '$castellano')";
        $result = mysqli_query($this->conexion, $sql);
    }

    // Actualizar una palabra existente
    public function actualizar($id, $euskera, $castellano)
    {
        $euskera = mysqli_real_escape_string($this->conexion, $euskera);
        $castellano = mysqli_real_escape_string($this->conexion, $castellano);
        $sql = "UPDATE glosario 
                SET palabra_euskera='$euskera', palabra_castellano='$castellano'
                WHERE id=$id";
        $result = mysqli_query($this->conexion, $sql);
    }

    // Eliminar una palabra
    public function eliminar($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM glosario WHERE id=$id";
        $result = mysqli_query($this->conexion, $sql);
    }
}
