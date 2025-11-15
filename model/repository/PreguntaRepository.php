<?php
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Categoria.class.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");


class PreguntaRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    function seleccionarPreguntasGenerales()
    {
        $sql = "SELECT id, pregunta, opcion1, opcion2, opcion3, correcta, usada, img, familiaId, categoriaId
                FROM preguntas
                WHERE familiaId is null AND usada = 0
                ORDER BY RAND()
                LIMIT 3;
                ";
        $result = mysqli_query($this->conexion, $sql);

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

                $familia = null;
                $categoria = null;

                if ($familiaId != null) {
                    $familia = new Familia($fila['familiaId'], "");
                } else if ($categoriaId != null) {
                    $categoria = new Categoria($fila['categoriaId'], "");
                }
                $pregunta = new Pregunta($id, $pregunta, $opcion1, $opcion2, $opcion3, $correcta,  $familia, $categoria, $usada, $img);
                $preguntas[] = $pregunta;
            }
            return $preguntas;
        }
        return [];
    }

    function seleccionarPreguntas($familiaId)
    {
        $sql = "SELECT id, pregunta, opcion1, opcion2, opcion3, correcta, usada, img, familiaId, categoriaId
                FROM preguntas
                WHERE familiaId = '$familiaId' AND usada = 0
                ORDER BY RAND()
                LIMIT 3;
                ";
        $result = mysqli_query($this->conexion, $sql);

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
                $pregunta = new Pregunta($id, $pregunta, $opcion1, $opcion2, $opcion3, $correcta, $familia, $categoria, $usada, $img);
                $preguntas[] = $pregunta;
            }
            return $preguntas;
        }
        return [];
    }

    function marcarPreguntasUsadasPorJuego($juegoId)
    {
        $sql = "UPDATE preguntas 
                SET usada = 1 
                WHERE id IN (
                    SELECT preguntaId 
                    FROM juegos_preguntas 
                    WHERE juegoId = $juegoId
                )";
        mysqli_query($this->conexion, $sql);
    }

    function guardarRespuestaUsuario($usuarioId, $juegoId, $preguntaId, $respuesta)
    {
        $sql = "INSERT INTO usuario_preguntas (usuarioId, juegoId, preguntaId, respuesta)
                VALUES ('$usuarioId', '$juegoId', '$preguntaId', '$respuesta')";
        mysqli_query($this->conexion, $sql);
    }

    public function getAllPreguntas($inicio, $porPagina)
    {

        $sql = "SELECT 
                p.id, p.pregunta, p.opcion1, p.opcion2, p.opcion3, p.correcta, 
                p.usada, p.img, 
                f.id AS familiaId, f.nombre AS familiaNombre,
                c.id AS categoriaId, c.nombre AS categoriaNombre
            FROM preguntas p
            LEFT JOIN familias f ON p.familiaId = f.id
            LEFT JOIN categorias c ON p.categoriaId = c.id
            ORDER BY p.id ASC
            LIMIT $inicio, $porPagina";

        $result = mysqli_query($this->conexion, $sql);
        $preguntas = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $familia = null;
                $categoria = null;

                if ($fila['familiaId'] != null) {
                    $familia = new Familia($fila['familiaId'], $fila['familiaNombre']);
                }

                if ($fila['categoriaId'] != null) {
                    $categoria = new Categoria($fila['categoriaId'], $fila['categoriaNombre']);
                }

                $preguntaObj = new Pregunta(
                    $fila['id'],
                    $fila['pregunta'],
                    $fila['opcion1'],
                    $fila['opcion2'],
                    $fila['opcion3'],
                    $fila['correcta'],
                    $familia,
                    $categoria,
                    $fila['usada'],
                    $fila['img']
                );

                $preguntas[] = $preguntaObj;
            }
        }

        return $preguntas;
    }

    public function contarPreguntas()
    {
        $sql = "SELECT COUNT(*) AS total FROM preguntas";
        $result = mysqli_query($this->conexion, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row ? (int)$row['total'] : 0;
    }

    public function getPreguntasPorFamilia($familiaId)
    {

        if ($familiaId === null) {
            // Preguntas generales
            $where = "p.familiaId IS NULL";
        } else {
            // Preguntas de una familia específica
            $where = "p.familiaId = '$familiaId'";
        }

        $sql = "SELECT p.id, p.pregunta, p.opcion1, p.opcion2, p.opcion3, p.correcta, p.usada, p.img,
                   f.id AS familiaId, f.nombre AS familiaNombre,
                   c.id AS categoriaId, c.nombre AS categoriaNombre
            FROM preguntas p
            LEFT JOIN familias f ON p.familiaId = f.id
            LEFT JOIN categorias c ON p.categoriaId = c.id
            WHERE $where
            ORDER BY p.id ASC";

        $result = mysqli_query($this->conexion, $sql);

        $preguntas = [];
        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $familia = $fila['familiaId'] ? new Familia($fila['familiaId'], $fila['familiaNombre']) : null;
                $categoria = $fila['categoriaId'] ? new Categoria($fila['categoriaId'], $fila['categoriaNombre']) : null;

                $pregunta = new Pregunta(
                    $fila['id'],
                    $fila['pregunta'],
                    $fila['opcion1'],
                    $fila['opcion2'],
                    $fila['opcion3'],
                    $fila['correcta'],
                    $familia,
                    $categoria,
                    $fila['usada'],
                    $fila['img']
                );

                $preguntas[] = $pregunta;
            }
        }
        return $preguntas;
    }

    public function crearPregunta($pregunta, $opcion1, $opcion2, $opcion3, $correcta, $familiaId = null, $categoriaId = null, $img = null)
    {
        // Validar coherencia del modelo: no puede tener familia y categoría a la vez
        if (!empty($familiaId) && !empty($categoriaId)) {
            throw new Exception("Una pregunta no puede tener familiaId y categoriaId al mismo tiempo.");
        }

        // Si no hay familia ni categoría, también es inválido
        if (empty($familiaId) && empty($categoriaId)) {
            throw new Exception("Debe especificarse una familia o una categoría para la pregunta.");
        }

        $preguntaSQL  = "'" . mysqli_real_escape_string($this->conexion, $pregunta) . "'";
        $opcion1SQL   = "'" . mysqli_real_escape_string($this->conexion, $opcion1) . "'";
        $opcion2SQL   = "'" . mysqli_real_escape_string($this->conexion, $opcion2) . "'";
        $opcion3SQL   = "'" . mysqli_real_escape_string($this->conexion, $opcion3) . "'";
        $correctaSQL  = "'" . mysqli_real_escape_string($this->conexion, $correcta) . "'";
        $usadaSQL     = 0;
        $familiaSQL   = $familiaId ? "'" . mysqli_real_escape_string($this->conexion, $familiaId) . "'" : "NULL";
        $categoriaSQL = $categoriaId ? "'" . mysqli_real_escape_string($this->conexion, $categoriaId) . "'" : "NULL";
        $imgSQL       = $img ? "'" . mysqli_real_escape_string($this->conexion, $img) . "'" : "NULL";


        // usada = 0 por defecto
         $sql = "INSERT INTO preguntas (pregunta, opcion1, opcion2, opcion3, correcta, usada, familiaId, categoriaId, img)
            VALUES ($preguntaSQL, $opcion1SQL, $opcion2SQL, $opcion3SQL, $correctaSQL, $usadaSQL, $familiaSQL, $categoriaSQL, $imgSQL)";


        $resultado = mysqli_query($this->conexion, $sql);

        if (!$resultado) {
            throw new Exception("Error al crear la pregunta: " . mysqli_error($this->conexion));
        }

        return true;
    }
}
