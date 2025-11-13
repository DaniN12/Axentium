<?php
require_once __DIR__ . "/../AccesoBD.class.php";
require_once __DIR__ . "/../Notificaciones.class.php";

class NotificacionesRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new AccesoBD();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM notificaciones ORDER BY id DESC";
        $result = $this->db->lanzarSQL($sql);

        $notificaciones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notificaciones[] = new Notificacion($row['id'], $row['texto']);
        }

        return $notificaciones;
    }

    public function add($texto)
    {
        $texto = mysqli_real_escape_string($this->db->conexion, $texto);
        $sql = "INSERT INTO notificaciones (texto) VALUES ('$texto')";
        $this->db->lanzarSQL($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM notificaciones WHERE id = $id";
        $this->db->lanzarSQL($sql);
    }
}
?>