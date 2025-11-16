<?php
require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Categoria.class.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");
require_once(BASE_PATH . "/model/Juego.class.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");

class PartidaRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    function crearPartida($juegoId, $usuarioId, $puntuacion, $fecha)
    {
        $fecha = $fecha->format('Y-m-d H:i:s');
        $sql = "INSERT INTO partidas (juegoId, usuarioId, puntuacion, fecha) VALUES ('$juegoId', '$usuarioId', '$puntuacion', '$fecha');";
        mysqli_query($this->conexion, $sql);
    }
    function getAllPuntuaciones()
    {
        $sql = "SELECT 
            u.id AS usuarioId, 
            u.username AS usuario, 
             c.nombre AS ciclo,
            SUM(p.puntuacion) AS puntuacion
        FROM partidas p
        INNER JOIN usuarios u ON p.usuarioId = u.id
        INNER JOIN ciclos c ON u.cicloId = c.id
        GROUP BY u.id, u.username
        ORDER BY puntuacion DESC;";
        $resultado = mysqli_query($this->conexion, $sql);

        $ranking = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $ranking[] = $fila;
        }
        return $ranking;
    }
    function getCountPartidas()
    {
        $sql = "SELECT COUNT(*) as total FROM partidas;";
        $result = mysqli_query($this->conexion, $sql);
        $fila = mysqli_fetch_assoc($result);
        return $fila['total'];
    }
    function getCountPartidasEstaSemana()
    {
        $sql = "SELECT COUNT(*) AS total 
            FROM partidas 
            WHERE YEARWEEK(fecha, 1) = YEARWEEK(NOW(), 1);";

        $result = mysqli_query($this->conexion, $sql);
        $fila = mysqli_fetch_assoc($result);
        return $fila['total'];
    }

    function getRankingPorCiclos()
    {
        $sql = "SELECT 
                c.id AS cicloId,
                c.nombre AS ciclo,
                COALESCE(SUM(p.puntuacion), 0) AS puntosTotales
            FROM ciclos c
            LEFT JOIN usuarios u ON u.cicloId = c.id
            LEFT JOIN partidas p ON p.usuarioId = u.id
            GROUP BY c.id, c.nombre
            ORDER BY puntosTotales DESC;";


        $resultado = mysqli_query($this->conexion, $sql);

        $ranking = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $ranking[] = $fila;
        }

        return $ranking;
    }
}
