<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/model/repository/CentroRepository.php';
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");
require_once(BASE_PATH . "/model/Usuario.class.php");
require_once(BASE_PATH . "/model/Juego.class.php");
session_start();

if (isset($_SESSION['familiaId'])) {
    $familiaId = $_SESSION['familiaId'];
} else {
    header('Location: ' . BASE_URL . 'index.php');
}

if (!isset($_SESSION['juegoActivo'])) {
    // No hay juego activo: limpia cualquier juego en sesión y redirige
    unset($_SESSION['juegoActivo']);
    header('Location: ' . BASE_URL . 'index.php?s=home');
} else {

    $juego = $_SESSION['juegoActivo'];
    $preguntas = $juego->getPreguntas();
    $_SESSION['preguntasJuego'] = $preguntas;
    header('Location: ' . BASE_URL . 'index.php?s=juego');
}
