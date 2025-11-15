<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/model/AccesoBD.class.php';
require_once(BASE_PATH . "/model/repository/PartidaRepository.php");
session_start();

$bd = new AccesoBD();
$partidaRepo = new PartidaRepository($bd->conexion);
$ranking = $partidaRepo->getAllPuntuaciones();

$_SESSION['ranking'] = $ranking;

header('Location: ' . BASE_URL . 'index.php?s=ranking');

?>