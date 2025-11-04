<?php
require_once(__DIR__ . '/../AccesoBD.class.php');
require_once(__DIR__ . '/../Glosario.class.php');

class GlosarioRepository {
    private $db;

    public function __construct() {
        $this->db = new AccesoBD(); // usa tu clase existente
    }

    // Obtener todas las palabras
    public function obtenerTodos() {
        $sql = "SELECT * FROM glosario ORDER BY palabra_euskera ASC";
        $result = $this->db->lanzarSQL($sql);

        $palabras = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $palabras[] = new Glosario($row['id'], $row['palabra_euskera'], $row['palabra_castellano']);
        }
        return $palabras;
    }

    // Agregar una palabra
    public function agregar($euskera, $castellano) {
        $euskera = mysqli_real_escape_string($this->db->conexion, $euskera);
        $castellano = mysqli_real_escape_string($this->db->conexion, $castellano);
        $sql = "INSERT INTO glosario (palabra_euskera, palabra_castellano)
                VALUES ('$euskera', '$castellano')";
        $this->db->lanzarSQL($sql);
    }

    // Actualizar una palabra existente
    public function actualizar($id, $euskera, $castellano) {
        $euskera = mysqli_real_escape_string($this->db->conexion, $euskera);
        $castellano = mysqli_real_escape_string($this->db->conexion, $castellano);
        $sql = "UPDATE glosario 
                SET palabra_euskera='$euskera', palabra_castellano='$castellano'
                WHERE id=$id";
        $this->db->lanzarSQL($sql);
    }

    // Eliminar una palabra
    public function eliminar($id) {
        $id = intval($id);
        $sql = "DELETE FROM glosario WHERE id=$id";
        $this->db->lanzarSQL($sql);
    }
}
?>
