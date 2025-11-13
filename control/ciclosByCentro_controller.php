<?php
require_once(__DIR__ . '/../config.php');
require_once(BASE_PATH . "/model/repository/CentroRepository.php");

header('Content-Type: application/json');

if (!isset($_GET['centroId']) || empty($_GET['centroId'])) {
    echo json_encode(['error' => 'centroId requerido']);
    exit;
}

$centroId = intval($_GET['centroId']);

$centroRepo = new CentroRepository();
$ciclos = $centroRepo->getCiclosByCentroId($centroId);

if (!$ciclos) {
    echo json_encode(['ciclos' => []]);
    exit;
}

$ciclosArray = [];
foreach ($ciclos as $ciclo) {
    $ciclosArray[] = [
        'id' => $ciclo->getId(),
        'nombre' => $ciclo->getNombre()
    ];
}

echo json_encode(['ciclos' => $ciclosArray]);
