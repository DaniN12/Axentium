<?php
require_once(__DIR__.'/../../config.php');
require_once(__DIR__."/../../model/repository/JuegoRepository.php");

$centro=$_POST['centro'];

//1. Obtener familias del centro

//2. Crear juego para cada familia   
$juegoRepository=new JuegoRepository();
$juegoRepository->crearJuego($username, $email, $pass, $centro, $ciclo);
header("Location: ../index.php?s=test-admin"); 



?>