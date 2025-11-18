<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/model/repository/CentroRepository.php';

$bd = new AccesoBD();
$repo = new CentroRepository($bd->conexion);
$centros = $repo->getCentros();
$action = $_POST['action'] ?? null;
echo "<pre>";
print_r($_POST);
echo "</pre>";

switch ($action) {
    case 'getAll':
        $centros = $repo->getCentros();
        echo "<h1>Todos los centros</h1>";
        echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Nombre</th><th>Localidad</th></tr>";
        foreach ($centros as $centro) {
            echo "<tr><td>{$centro->getId()}</td><td>{$centro->getNombre()}</td><td>{$centro->getLocalidad()}</td></tr>";
        }
        echo "</table>";
        break;

    case 'getCiclosByCentro':
        $centroId = $_POST['centro'] ?? null;
        if (!$centroId) {
            echo "<p>Error: no se recibió el ID del centro.</p>";
        }

        $ciclos = $repo->getCiclosByCentroId($centroId);

        if (!$ciclos) {
            echo "<p>No se encontraron ciclos para el centro seleccionado.</p>";
        } else {
            echo "<h1>Ciclos del centro ID $centroId</h1>";
            echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Nombre</th><th>Familia</th></tr>";
            foreach ($ciclos as $ciclo) {
                echo "<tr><td>{$ciclo->getId()}</td><td>{$ciclo->getNombre()}</td><td>{$ciclo->getFamilia()->getNombre()}</td></tr>";
            }
            echo "</table>";
        }
        break;

    case 'getFamiliasByCentro':
        $centroId = $_POST['centro'] ?? null;
        if (!$centroId) {
            echo "<p>Error: no se recibió el ID del centro.</p>";
        }

        $familias = $repo->getFamiliasByCentroId($centroId);

        if (!$familias) {
            echo "<p>No se encontraron familias para el centro seleccionado.</p>";
        } else {
            echo "<h1>Familias del centro ID $centroId</h1>";
            echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Nombre</th></tr>";
            foreach ($familias as $familia) {
                echo "<tr><td>{$familia->getId()}</td><td>{$familia->getNombre()}</td></tr>";
            }
            echo "</table>";
        }
        break;

    default:
        echo "<p>Acción no válida.</p>";
        break;
}

echo "<p><a href='" . BASE_URL . "index.php?s=test-admin'>⬅️ Volver</a></p>";
