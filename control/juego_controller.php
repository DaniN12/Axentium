<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/model/repository/CentroRepository.php';
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");

if(isset($_SESSION['familiaId'])) {
    $familiaId = $_SESSION['familiaId'];
} else {
    header('Location: ' . BASE_URL . 'index.php');
}

$juegoRepo = new JuegoRepository();
$juegoActivo = $juegoRepo->getJuegoActivoByFamilia($familiaId);
if($juegoActivo != null){
    $_SESSION['juegoActivo'] = $juegoActivo;
}
header('Location: ' . BASE_URL . 'index.php');

?>