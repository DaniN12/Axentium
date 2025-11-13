<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/model/repository/CentroRepository.php";
require_once BASE_PATH . "/model/repository/CicloRepository.php";
require_once BASE_PATH . "/model/repository/FamiliaRepository.php";
require_once BASE_PATH . "/model/repository/CategoriaRepository.php";
require_once BASE_PATH . "/model/repository/JuegoRepository.php";
require_once BASE_PATH . "/model/repository/UsuarioRepository.php";
require_once BASE_PATH . "/model/repository/PreguntaRepository.php";
require_once BASE_PATH . "/model/repository/GlosarioRepository.php";
session_start();

if(!isset($_SESSION['admin'])){
    header('Location: ../index.php?s=home');
}
if(!isset($_SESSION['usuario'])){
    header('Location: ../index.php?s=login');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Panel de Administración - LHizki</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="../css/estilos.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="bg-dark text-white p-3 vh-100 sticky-top admin-sidebar">
            <h4 class="mb-4 text-center">LHizki Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="?s=home" class="nav-link text-white"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="?s=juegos" class="nav-link text-white"><i class="fa-solid fa-gamepad"></i> Juegos</a></li>
                <li class="nav-item mb-2"><a href="?s=usuarios" class="nav-link text-white"><i class="fa-solid fa-users"></i> Usuarios</a></li>
                <li class="nav-item mb-2"><a href="?s=glosario_admin" class="nav-link text-white"><i class="fa-solid fa-book"></i> Glosario</a></li>
                <li class="nav-item mb-2"><a href="?s=preguntas" class="nav-link text-white"><i class="fa-solid fa-question"></i> Preguntas</a></li>
                <li class="nav-item mt-4"><a href="../index.php" class="nav-link text-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</a></li>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-grow-1 p-4">
            <nav class="navbar navbar-light bg-white shadow-sm mb-4 rounded-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h5">Panel de Administración</span>
                    <a href="<?= BASE_URL ?>control/logout_controller.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
                </div>
            </nav>

            <div class="container-fluid">
                <?php
                //Cargar sección correspondiente
                $view = "home";
                if (isset($_GET['s'])) {
                    $view = $_GET['s'];
                }
                include "./sections/$view.php";
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="../js/admin_script.js"></script>
</body>

</html>