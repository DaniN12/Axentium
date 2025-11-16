<?php
require_once __DIR__ . "/config.php";
require_once BASE_PATH . '/model/AccesoBD.class.php';
require_once BASE_PATH . '/model/Rol.class.php';
require_once BASE_PATH . '/model/Ciclo.class.php';
require_once BASE_PATH . '/model/Familia.class.php';
require_once BASE_PATH . '/model/Usuario.class.php';
require_once BASE_PATH . '/model/Categoria.class.php';
require_once BASE_PATH . '/model/Pregunta.class.php';
require_once BASE_PATH . '/model/Partida.class.php';
require_once BASE_PATH . '/model/Juego.class.php';
require_once BASE_PATH . '/model/Glosario.class.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Axentium</title>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> -->

    <!-- FontAwesome -->
    <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body class="bg-primary-light">

    <!-- Navbar superior con menú hamburguesa -->
    <nav class="navbar navbar-expand-md  bg-light   fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>control/home_controller.php">

                <!-- <img src="assets/img/LhizkiLogo.png" alt="Logo" height="40"> -->
                <!--Nuevo SVG  -->
                <svg id="Capa_1" data-name="Capa 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 271.866 209.348"
                    width="100%" height="40">
                    <!-- Fondo (color editable por CSS) -->
                    <path class="icon-bg"
                        d="M1069.921,512.889a27.046,27.046,0,0,0-13.31,3.5,6.063,6.063,0,0,1-9.018-5.3V463.41a24.114,24.114,0,0,0-24.114-24.114H850.57a24.114,24.114,0,0,0-24.114,24.114V624.529a24.114,24.114,0,0,0,24.114,24.114h172.909a24.114,24.114,0,0,0,24.114-24.114V574.713a6.063,6.063,0,0,1,9.018-5.3,27.047,27.047,0,0,0,13.31,3.5c15.685,0,28.4-13.436,28.4-30.009S1085.606,512.889,1069.921,512.889Z"
                        transform="translate(-826.456 -439.296)" />
                    <!-- Negro -->
                    <ellipse cx="67.52" cy="86.633" rx="19.649" ry="23.4" fill="#230b07" />
                    <ellipse cx="155.582" cy="86.633" rx="19.649" ry="23.4" fill="#230b07" />
                    <!-- Blanco -->
                    <circle cx="74.628" cy="80.535" r="6.098" fill="#fffdf7" />
                    <circle cx="162.689" cy="80.535" r="6.098" fill="#fffdf7" />
                    <!-- Boca (negro) -->
                    <path d="M908.574,562.756c5.051,24.653,53.815,23.488,57.847,0"
                        transform="translate(-826.456 -439.296)"
                        fill="none" stroke="#000" stroke-linecap="round"
                        stroke-linejoin="bevel" stroke-width="10" />
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <?php if (!isset($_SESSION['usuario'])): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?s=login">Login</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>control/logout_controller.php">Cerrar sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="container ">
        <?php
        if (isset($_SESSION['flash'])) {
            echo "<div class='alert alert-{$_SESSION['flash-type']} mt-3'>{$_SESSION['flash']}</div>";
            unset($_SESSION['flash'], $_SESSION['flash-type']);
        }

        $view = $_GET['s'] ?? 'home';
        // if ($view === 'glosario_user') {
        //     require_once BASE_PATH . '/control/glosario_controller.php';
        // }
        include "./sections/$view.php";

        ?>
    </main>

    <!-- Menú inferior fijo (navegación principal tipo app móvil) -->

    <?php if (isset($_SESSION['usuario']) && !isset($_SESSION['admin']) && $view !== 'juego') { ?>

        <nav class="bottom-nav shadow-sm text-dark">
            <a href="<?= BASE_URL ?>control/home_controller.php" class="<?= ($view === 'home') ? 'active' : '' ?>">
                <i class="fas fa-home"></i>
                <span class="d-block">Inicio</span>
            </a>

            <a href="<?= BASE_URL ?>control/ranking_controller.php" class="<?= ($view === 'ranking') ? 'active' : '' ?>">
                <i class="fas fa-crown"></i>
                <span class="d-block">Ranking</span>
            </a>
            <a href="<?= BASE_URL ?>control/glosario_controller.php" class="<?= ($view === 'glosario_user') ? 'active' : '' ?>">
                <i class="fas fa-book"></i>
                <span class="d-block">Glosario</span>
            </a>

            <a href="index.php?s=notificaciones_user" class="<?= ($view === 'notificaciones_user') ? 'active' : '' ?>">
                <i class="fas fa-bell"></i>
                <span class="d-block">Avisos</span>
            </a>
        </nav>
    <?php } ?>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/juego.js"></script>

    <script src="js/user_script.js"></script>
</body>

</html>