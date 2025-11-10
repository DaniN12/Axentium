<?php
require_once(__DIR__ . '/../config.php');
// require_once "../model/User.class.php";
session_start();
// $name = $_SESSION['user']->getUsername();
session_destroy(); 

// $_SESSION['flash'] = "Hasta pronto, $name";
// $_SESSION['flash-type'] = "info";
header('Location: ' . BASE_URL . 'index.php?s=login');
