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
            MAX(p.puntuacion) AS puntuacion
        FROM partidas p
        INNER JOIN usuarios u ON p.usuarioId = u.id
        GROUP BY u.id, u.username
        ORDER BY puntuacion DESC;";
        $resultado = mysqli_query($this->conexion, $sql);

        $ranking = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $ranking[] = $fila;
        }
        return $ranking;
    }
}
