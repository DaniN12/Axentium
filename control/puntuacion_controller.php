<?php
require_once __DIR__ . '/../config.php';
require_once(BASE_PATH . "/model/Usuario.class.php");
require_once(BASE_PATH . "/model/Juego.class.php");
require_once(BASE_PATH . "/model/Partida.class.php");
require_once(BASE_PATH . "/model/repository/PartidaRepository.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'index.php');
}
$bd = new AccesoBD();
$conexion = $bd->conexion;
$juegoId = $_SESSION['juegoActivo']->getId();
$usuarioId = $_SESSION['usuario']->getId();
$puntuacion = $_POST['puntuacion'];
$fecha = new DateTime();

$preguntas = $_SESSION['juegoActivo']->getPreguntas();
$respuestas = json_decode($_POST['respuestas'], true);

$_SESSION['partida'] = new Partida($_SESSION['usuario'], $_SESSION['juegoActivo'], $puntuacion, $fecha);
$partidaRepo = new PartidaRepository($conexion);
$partidaRepo->crearPartida($juegoId, $usuarioId, $puntuacion, $fecha);

$preguntasRepo = new PreguntaRepository($conexion);

for ($i = 0; $i < count($preguntas); $i++) {
    $preguntaId = $preguntas[$i]->getId();
    $respuesta = intval($respuestas[$i]);
    $preguntasRepo->guardarRespuestaUsuario($usuarioId, $juegoId, $preguntaId, $respuesta);
}

header('Location: ' . BASE_URL . 'index.php?s=juego_finalizado');

?>