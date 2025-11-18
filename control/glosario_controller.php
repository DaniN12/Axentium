<?php
session_start();
require_once(__DIR__ . '/../config.php');
require_once BASE_PATH . '/model/AccesoBD.class.php';
require_once BASE_PATH . '/model/repository/GlosarioRepository.php';

$bd = new AccesoBD();
$conexion = $bd->conexion;
$repo = new GlosarioRepository($conexion);
$_SESSION['glosario'] = [];
$_SESSION['glosario'] = $repo->obtenerTodos();
// var_dump($_SESSION['glosario']);die();
header('Location: ' . BASE_URL . 'index.php?s=glosario_user');
