
<?php
require_once __DIR__ . "/config.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estilos.css">

    <title>LHizki</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">LHizki</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mb-2 mb-md-0">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?s=test-admin">Test Admin</a>
                    </li>

                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="control/logout_controller.php">Logout</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=registro">Registro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=login">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=glosario_admin">GlosarioAdmin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=glosario_user">GlosarioUser</a>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        <?php
        if (isset($_SESSION['flash'])) {
            // echo $_SESSION['flash-type'];
        ?>
            <div class='alert alert-<?php echo $_SESSION['flash-type'] ?>' role="alert">
                <?php echo $_SESSION['flash'] ?>
            </div>
        <?php
            unset($_SESSION['flash']);
            unset($_SESSION['flash-type']);
        }
        ?>
        <?php
        //Cargar sección correspondiente
        $view = "home";
        if (isset($_GET['s'])) {
            $view = $_GET['s'];
        }
        include "./sections/$view.php";

        ?>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>

</html>