<?php
session_start();
require_once(__DIR__ . '/../config.php');
require_once BASE_PATH . '/model/repository/UsuarioRepository.php';
require_once BASE_PATH . '/model/AccesoBD.class.php';

$username = $_POST['username'];
$password = md5(trim($_POST['password']));

$usuarioRepository = new UsuarioRepository();
$user = $usuarioRepository->getUser($username, $password);

if ($user) {
    // Guardar datos en la sesión
    $_SESSION['usuario'] = $user;
    $userRol = $user->getRol();

    // Redirigir según el rol
    $rolLogueado = strtolower($user->getRol()->getRolName());

    if ($rolLogueado == 'admin' || $rolLogueado == 'sa') {
        $_SESSION['admin'] = true;
        header('Location: ' . BASE_URL . 'admin/index.php?s=home');

    } else if($rolLogueado == 'usuario') {

        header('Location: ' . BASE_URL . 'index.php?s=home');
    }

} else {
    // Mostrar flash de error, redirigir a login
    header('Location: ' . BASE_URL . 'index.php?s=login');
}
