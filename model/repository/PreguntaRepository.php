<?php
require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Categoria.class.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");


class PreguntaRepository
{

    function seleccionarPreguntasGenerales()
    {
        $bd = new AccesoBD();
        $sql = "SELECT id, pregunta, opcion1, opcion2, opcion3, correcta, usada, img, familiaId, categoriaId
                FROM preguntas
                WHERE familiaId is null AND usada = 0
                ORDER BY RAND()
                LIMIT 1;
                ";
        $result = mysqli_query($bd->conexion, $sql);

        $preguntas = [];
        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $id = $fila['id'];
                $pregunta = $fila['pregunta'];
                $opcion1 = $fila['opcion1'];
                $opcion2 = $fila['opcion2'];
                $opcion3 = $fila['opcion3'];
                $correcta = $fila['correcta'];
                $usada = $fila['usada'];
                $img = $fila['img'];
                $familiaId = $fila['familiaId'];
                $categoriaId = $fila['categoriaId'];

                if ($familiaId != null) {
                    $familia = new Familia($fila['familiaId'], "");
                } else if ($categoriaId != null) {
                    $categoria = new Categoria($fila['categoriaId'], "");
                }
                $pregunta = new Pregunta($id, $pregunta, $opcion1, $opcion2, $opcion3, $correcta, $usada, $img, $familia, $categoria);
                $preguntas[] = $pregunta;
            }
            return $preguntas;
        }
        return null;
    }

    function seleccionarPreguntas($familiaId)
    {
        $bd = new AccesoBD();
        $sql = "SELECT id, pregunta, opcion1, opcion2, opcion3, correcta, usada, img, familiaId, categoriaId
                FROM preguntas
                WHERE familiaId = '$familiaId' AND usada = 0
                ORDER BY RAND()
                LIMIT 1;
                ";
        $result = mysqli_query($bd->conexion, $sql);

        $preguntas = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $familia = null;
                $categoria = null;
                $id = $fila['id'];
                $pregunta = $fila['pregunta'];
                $opcion1 = $fila['opcion1'];
                $opcion2 = $fila['opcion2'];
                $opcion3 = $fila['opcion3'];
                $correcta = $fila['correcta'];
                $usada = $fila['usada'];
                $img = $fila['img'];
                $familiaId = $fila['familiaId'];
                $categoriaId = $fila['categoriaId'];

                if ($familiaId != null) {
                    $familia = new Familia($fila['familiaId'], "");
                } else if ($categoriaId != null) {
                    $categoria = new Categoria($fila['categoriaId'], "");
                }
                $pregunta = new Pregunta($id, $pregunta, $opcion1, $opcion2, $opcion3, $correcta, $usada, $img, $familia, $categoria);
                $preguntas[] = $pregunta;
            }
            return $preguntas;
        }
        return null;
    }
}
