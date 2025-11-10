<?php
require_once(__DIR__ . "/../AccesoBD.class.php");
require_once(__DIR__ . "/../Familia.class.php");
require_once(__DIR__ . "/../Ciclo.class.php");

class CategoriaRepository
{

    function getCategorias()
    {
        $bd = new AccesoBD();
        $sql = "SELECT id, nombre
            FROM categorias
            ;";
        $result = mysqli_query($bd->conexion, $sql);

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
