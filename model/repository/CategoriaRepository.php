<?php
require_once(__DIR__ . "/../Familia.class.php");
require_once(__DIR__ . "/../Ciclo.class.php");

class CategoriaRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function getCategorias()
    {
        $sql = "SELECT id, nombre
            FROM categorias
            ;";
        $result = mysqli_query($this->conexion, $sql);

        $categorias = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $categorias[] = new Categoria($id, $nombre);
            }
            return $categorias;
        }
        return null;
    }

}
