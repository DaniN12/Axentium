<?php
require_once(__DIR__ . '/../../config.php');
require_once(BASE_PATH . '/model/AccesoBD.class.php');
require_once(BASE_PATH . "/model/repository/GlosarioRepository.php");

$bd = new AccesoBD();
$repo = new GlosarioRepository($bd->conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $repo->agregar($_POST['palabra_euskera'], $_POST['palabra_castellano']);
    } elseif (isset($_POST['editar'])) {
        $repo->actualizar($_POST['id'], $_POST['palabra_euskera'], $_POST['palabra_castellano']);
    } elseif (isset($_POST['eliminar'])) {
        $repo->eliminar($_POST['id']);
    }
    header('Location: ' . BASE_URL . 'admin/index.php?s=glosario_admin');
}
?>
