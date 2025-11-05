<?php

use Dom\Mysql;

require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");

class JuegoRepository
{

    function crearJuego($familiaId, $fecha_inicio, $fecha_fin)
    {
        $bd = new AccesoBD();
        $this->actualizarJuegosActivos();
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

    function actualizarJuegosActivos() {
        $bd = new AccesoBD();
        $sql = "SELECT id, fecha_fin 
                FROM juegos 
                WHERE activo = 1";
        $result = $bd->lanzarSQL($sql);

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $juegoId = $fila['id'];
                $fechaFin = $fila['fecha_fin'];

                if (strtotime($fechaFin) < time()) {
                    $bd->lanzarSQL("UPDATE juegos SET activo = 0 WHERE id = $juegoId");
                    $preguntaRepo = new PreguntaRepository();
                    $preguntaRepo->marcarPreguntasUsadasPorJuego($juegoId);
                }
            }
        }
    }
}
