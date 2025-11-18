<?php
require_once(__DIR__ . '/../../config.php');
require_once(BASE_PATH . "/model/repository/UsuarioRepository.php");

if (!isset($_SESSION['admin'])) {
    header('Location: ' . BASE_URL . 'index.php?s=login');
}

$bd = new AccesoBD();
$usuarioRepo = new UsuarioRepository($bd->conexion);
$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action == 'editar') {
    // $usuarioRepo->editarUsuario($_POST['id'], $_POST['username'], $_POST['email'], $_POST['pass'], $_POST['centroId'], $_POST['cicloId'], $_POST['rolId']);
} else if ($action == 'eliminar') {
    $usuarioRepo->eliminarUsuario($_GET['id']);
}

header('Location: ' . BASE_URL . 'admin/index.php?s=usuarios');

?>
