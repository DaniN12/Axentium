<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__."/../model/repository/UsuarioRepository.php");

$username=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$centro=$_POST['centro'];
$ciclo=$_POST['ciclo'];

if($pass != $pass2){
    echo($pass);
    echo($pass2);
    //Poner mensaje flash: contraseñas no coinciden
    header('Location:../index.php?s=registro');

}else if($centro != '' && $ciclo != '') {
    
    $usuarioRepository=new UsuarioRepository();
    $usuarioRepository->registrarUsuario($username, $email, $pass, $centro, $ciclo);
    header("Location: ../index.php?s=login"); 
} else {

    //Poner mensaje flash: no se ha seleccionado centro o ciclo
    header('Location:../index.php?s=registro');
}

?>