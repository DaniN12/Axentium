<?php
require_once __DIR__ . "/config.php";
require_once BASE_PATH . '/model/Rol.class.php';
require_once BASE_PATH . '/model/Ciclo.class.php';
require_once BASE_PATH . '/model/Familia.class.php';
require_once BASE_PATH . '/model/Usuario.class.php';
require_once BASE_PATH . '/model/Juego.class.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LHizki</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/estilos.css">

    <style>
        /*  Estilos adicionales */
        body {
            background-color: #f8f9fa;
            padding-bottom: 70px;
            /* espacio para el menú inferior */
            font-family: system-ui, sans-serif;
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* 🔽 Menú inferior fijo estilo app */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-around;
            padding: 8px 0;
            z-index: 1030;
        }

        .bottom-nav a {
            text-decoration: none;
            color: #6c757d;
            font-size: 0.8rem;
            text-align: center;
        }

        .bottom-nav a.active {
            color: #0d6efd;
        }

        .bottom-nav i {
            display: block;
            font-size: 1.4rem;
        }

        main.container {
            margin-top: 4rem;
        }
    </style>
</head>

<body>

    <!-- Navbar superior con menú hamburguesa -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">LHizki</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="index.php?s=test-admin">Test Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=registro">Registro</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=glosario_admin">Glosario Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?s=glosario_user">Glosario User</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="container">
        <?php
        if (isset($_SESSION['flash'])) {
            echo "<div class='alert alert-{$_SESSION['flash-type']} mt-3'>{$_SESSION['flash']}</div>";
            unset($_SESSION['flash'], $_SESSION['flash-type']);
        }

        $view = "home";
        if (isset($_GET['s'])) {
            $view = $_GET['s'];
        }
        include "./sections/$view.php";

        ?>
    </main>

    <!-- Menú inferior fijo (navegación principal tipo app móvil) -->
    <nav class="bottom-nav shadow-sm text-dark">
        <a href="index.php?s=home" class="active ">
            <i class="fas fa-home"></i>
            <span class="d-block">Inicio</span>
        </a>
        <a href="index.php">
            <i class="fas fa-crown"></i>
            <span class="d-block">Ranking</span>
        </a>
        <a href="index.php?s=glosario_user">
            <i class="fas fa-book"></i>
            <span class="d-block">Glosario</span>
        </a>
        <a href="index.php">
            <i class="fas fa-bell"></i>
            <span class="d-block">Avisos</span>
        </a>
    </nav>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Activar icono del menú inferior según URL
        const links = document.querySelectorAll('.bottom-nav a');
        const current = window.location.search;
        links.forEach(link => {
            if (link.href.includes(current)) {
                link.classList.add('active');
            }
        });
    </script>
</body>

</html>