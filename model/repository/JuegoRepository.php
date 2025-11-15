<?php
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Categoria.class.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");
require_once(BASE_PATH . "/model/Juego.class.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");

class JuegoRepository
{
    private $conexion;
    private $preguntaRepo;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
        $this->preguntaRepo = new PreguntaRepository($conexion);
    }

    function crearJuego($familiaId, $fecha_inicio, $fecha_fin)
    {
        $sqlInsert = "INSERT INTO juegos(familiaId, activo, fecha_inicio, fecha_fin)
                    VALUES ('$familiaId', 1, '$fecha_inicio', '$fecha_fin')";
        if (mysqli_query($this->conexion, $sqlInsert)) {
            $nuevoJuegoId = mysqli_insert_id($this->conexion);
            return $nuevoJuegoId;
        } else {
            return null;
        }
    }

    function addPreguntaToJuego($juegoId, $preguntaId)
    {
        $sql = "INSERT INTO juegos_preguntas (juegoId, preguntaId) VALUES ('$juegoId', '$preguntaId');";
        mysqli_query($this->conexion, $sql);
    }

    // Bulk insert: inserta muchas filas en una sola consulta, para mejorar eficiencia
    function addPreguntasToJuegoBulk($juegoId, array $preguntasIds)
    {
        if (empty($preguntasIds)) return;

        $juegoId = (int)$juegoId;
        $values = [];
        foreach ($preguntasIds as $pid) {
            $pid = (int)$pid;
            $values[] = "($juegoId, $pid)";
        }
        $sql = "INSERT INTO juegos_preguntas (juegoId, preguntaId) VALUES " . implode(", ", $values) . ";";
        mysqli_query($this->conexion, $sql);
    }

    function actualizarJuegosActivos()
    {
        $sql = "SELECT id, fecha_fin 
                FROM juegos 
                WHERE activo = 1";
        $result = mysqli_query($this->conexion, $sql);

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                $juegoId = $fila['id'];
                $fechaFin = $fila['fecha_fin'];

                if (strtotime($fechaFin) < time()) {
                    $sqlUpdate = "UPDATE juegos SET activo = 0 WHERE id = $juegoId";
                    mysqli_query($this->conexion, $sqlUpdate);
                    $this->preguntaRepo->marcarPreguntasUsadasPorJuego($juegoId);
                }
            }
        }
    }

    function getJuegoActivoByFamilia($familiaId)
    {
        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE j.familiaId = '$familiaId' AND j.activo = 1
            LIMIT 1;";

        $result = mysqli_query($this->conexion, $sql);
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
    function getJuegosPorEstado(string $estado = 'activos')
    {
        switch ($estado) {
            case 'activos':
                $where = "NOW() BETWEEN j.fecha_inicio AND j.fecha_fin";
                break;
            case 'proximos':
                $where = "NOW() < j.fecha_inicio";
                break;
            case 'pasados':
                $where = "NOW() > j.fecha_fin";
                break;
            default:
                $where = "1"; // Todos los juegos
                break;
        }

        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE $where
            ORDER BY j.fecha_inicio ASC";

        $result = mysqli_query($this->conexion, $sql);
        $juegos = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
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

                $juegos[] = $juego;
            }
        }

        return $juegos;
    }

    function getJuegosActivos()
    {
        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE NOW() BETWEEN j.fecha_inicio AND j.fecha_fin;";

        $result = mysqli_query($this->conexion, $sql);
        $juegos = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
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

                $juegos[] = $juego;
            }
        }

        return $juegos;
    }

    function getProximosJuegos()
    {

        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE NOW() < j.fecha_inicio;";

        $result = mysqli_query($this->conexion, $sql);
        $juegos = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
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

                $juegos[] = $juego;
            }
        }

        return $juegos;
    }

    function getJuegosPasados()
    {
        $sql = "SELECT 
                j.id, j.activo, j.fecha_inicio, j.fecha_fin, 
                f.id AS familiaId, f.nombre AS familiaNombre
            FROM juegos j
            INNER JOIN familias f ON j.familiaId = f.id
            WHERE NOW() > j.fecha_fin;";

        $result = mysqli_query($this->conexion, $sql);
        $juegos = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
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

                $juegos[] = $juego;
            }
        }

        return $juegos;
    }

    function getPreguntasByJuego($juegoId)
    {
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

        $result = mysqli_query($this->conexion, $sql);
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
                    $familia,
                    $categoria,
                    $fila['usada'],
                    $fila['img'],
                );
                $preguntas[] = $pregunta;
            }
        }
        return $preguntas;
    }

    function isJuegoJugado($juegoId, $usuarioId)
    {
        $sql = "SELECT juegoId FROM partidas 
        WHERE juegoId = '$juegoId' 
          AND usuarioId = '$usuarioId'
          ";
        $result = mysqli_query($this->conexion, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function eliminarJuego($juegoId)
    {
        $sql = "DELETE FROM juegos WHERE id = '$juegoId';";
        mysqli_query($this->conexion, $sql);
    }
}
