<?php
require_once __DIR__ . '/../config.php';
require_once(BASE_PATH . "/model/repository/PartidaRepository.php");
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'index.php');
}

$partidaRepo = new PartidaRepository();
$ranking = $partidaRepo->getAllPuntuaciones();

$_SESSION['ranking'] = $ranking;

header('Location: ' . BASE_URL . 'index.php?s=ranking');

?>