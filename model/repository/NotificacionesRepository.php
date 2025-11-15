<?php
require_once __DIR__ . "/../Notificaciones.class.php";

class NotificacionesRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM notificaciones ORDER BY id DESC";
        $result = mysqli_query($this->conexion, $sql);

        $notificaciones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notificaciones[] = new Notificacion($row['id'], $row['texto'], $row['fecha']);
        }

        return $notificaciones;
    }

    public function add($texto)
    {
        $texto = mysqli_real_escape_string($this->conexion, $texto);
        $sql = "INSERT INTO notificaciones (texto, fecha) VALUES ('$texto', NOW())";
        mysqli_query($this->conexion, $sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM notificaciones WHERE id = $id";
        mysqli_query($this->conexion, $sql);
    }
}
?>