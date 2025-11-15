<?php

use Dom\Attr;

require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/model/AccesoBD.class.php';
require_once BASE_PATH . '/model/repository/JuegoRepository.php';
require_once BASE_PATH . '/model/Usuario.class.php';
require_once BASE_PATH . '/model/Ciclo.class.php';
require_once BASE_PATH . '/model/Familia.class.php';
require_once BASE_PATH . '/model/Juego.class.php';

session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'index.php?s=login');
}
$bd = new AccesoBD();
$conexion = $bd->conexion;
$usuario = $_SESSION['usuario'];
$familiaId = $usuario->getCiclo()->getFamilia()->getId();
$juegoRepo = new JuegoRepository($conexion);
$juegoActivo = $juegoRepo->getJuegoActivoByFamilia($familiaId);

$msg = '';

// No hay juego activo
if ($juegoActivo === null) {
    unset($_SESSION['juegoActivo']);
    $msg = 'none';
} 
// Ya jugado
else if ($juegoRepo->isJuegoJugado($juegoActivo->getId(), $usuario->getId())) {
    unset($_SESSION['juegoActivo']);
    $msg = 'jugado';
} 
// Juego disponible
else {
    $_SESSION['juegoActivo'] = $juegoActivo;
}

header('Location: ' . BASE_URL . 'index.php?s=home&msg=' . $msg);
?>
