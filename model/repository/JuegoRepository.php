<?php

use Dom\Mysql;

require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Categoria.class.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");
require_once(BASE_PATH . "/model/Juego.class.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");

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

    function actualizarJuegosActivos()
    {
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

    function getJuegoActivoByFamilia($familiaId)
    {
        $bd = new AccesoBD();
        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE j.familiaId = '$familiaId' AND j.activo = 1
            LIMIT 1;";

        $result = mysqli_query($bd->conexion, $sql);
        if ($result && $fila = mysqli_fetch_assoc($result)) {
            $fechaInicio = new DateTime($fila['fecha_inicio']);
            $fechaFin = new DateTime($fila['fecha_fin']);
            $familia = new Familia($fila['familiaId'], $fila['familiaNombre']);

            $juego = new Juego(
                $fila['id'],
                $fila['activo'],
                $fechaInicio,
                $fechaFin,
                $familia
            );

            $preguntas = $this->getPreguntasByJuego($juego->getId());
            $juego->setPreguntas($preguntas);
            return $juego;
        }
        return null;
    }

    function getPreguntasByJuego($juegoId)
    {
        $bd = new AccesoBD();
        // $sql = "SELECT p.id, p.pregunta, p.correcta, p.opcion1, p.opcion2, p.opcion3, p.img, p.categoria, p.familiaId, p.usada
        //     FROM preguntas p
        //     INNER JOIN juegos_preguntas jp ON p.id = jp.preguntaId
        //     WHERE jp.juegoId = '$juegoId';";
        $sql = "SELECT 
                    p.id, p.pregunta, p.correcta, p.opcion1, p.opcion2, p.opcion3, 
                    p.img, p.usada,
                    f.id AS familiaId, f.nombre AS familiaNombre,
                    cat.id AS categoriaId, cat.nombre AS categoriaNombre
                FROM preguntas p
                INNER JOIN juegos_preguntas jp ON p.id = jp.preguntaId
                LEFT JOIN familias f ON p.familiaId = f.id
                LEFT JOIN categorias cat ON p.categoriaId = cat.id
                WHERE jp.juegoId = '$juegoId';";

        $result = mysqli_query($bd->conexion, $sql);
        $preguntas = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $familia = !empty($fila['familiaId'])
                    ? new Familia($fila['familiaId'], $fila['familiaNombre'])
                    : null;

                $categoria = !empty($fila['categoriaId'])
                    ? new Categoria($fila['categoriaId'], $fila['categoriaNombre'])
                    : null;

                $pregunta = new Pregunta(
                    $fila['id'],
                    $fila['pregunta'],
                    $fila['opcion1'],
                    $fila['opcion2'],
                    $fila['opcion3'],
                    $fila['correcta'],
                    $fila['usada'],
                    $fila['img'],
                    $familia,
                    $categoria
                );
                $preguntas[] = $pregunta;
            }
        }
        return $preguntas;
    }
}
