<?php
require_once(BASE_PATH . "/model/AccesoBD.class.php");

class JuegoRepository
{

    function crearJuego($familiaId, $fecha_inicio, $fecha_fin)
    {
        $bd = new AccesoBD();

        // 0.Validar si ya existe un juego activo para esa familia en esas fechas
        $sqlInsert = "INSERT INTO juegos(familiaId, activo, fecha_inicio, fecha_fin)
                    VALUES ('$familiaId', 1, '$fecha_inicio', '$fecha_fin')";
         if (mysqli_query($bd->conexion, $sqlInsert)) {
            $nuevoJuegoId = mysqli_insert_id($bd->conexion);
            return $nuevoJuegoId;
        } else {
            return null;
        }

        return true;
    }

    function addPreguntaToJuego($juegoId, $preguntaId)
    {
        $bd = new AccesoBD();
        $sql = "INSERT INTO juegos_preguntas (juegoId, preguntaId) VALUES ('$juegoId', '$preguntaId');";
        mysqli_query($bd->conexion, $sql);
    }
}
