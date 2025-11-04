<?php
require_once(__DIR__ . '/../model/repository/GlosarioRepository.php');

$repo = new GlosarioRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $repo->agregar($_POST['palabra_euskera'], $_POST['palabra_castellano']);
    } elseif (isset($_POST['editar'])) {
        $repo->actualizar($_POST['id'], $_POST['palabra_euskera'], $_POST['palabra_castellano']);
    } elseif (isset($_POST['eliminar'])) {
        $repo->eliminar($_POST['id']);
    }
    header("Location: ../sections/glosario_admin.php");
    exit;
}
?>
