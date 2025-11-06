<?php
// home.php
require_once BASE_PATH . '/model/Rol.class.php';
require_once BASE_PATH . '/model/Ciclo.class.php';
require_once BASE_PATH . '/model/Familia.class.php';
require_once BASE_PATH . '/model/Usuario.class.php';
require_once BASE_PATH . '/model/Juego.class.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="container mt-4">
    <h1 class="mb-3">Bienvenido a LHizki 👋</h1>

    <?php if (isset($_SESSION['usuario'])): ?>
        <?php 
            $usuario = $_SESSION['usuario'];
            $rol = strtolower($usuario->getRol()->getRolName());
            $nombreUsuario = htmlspecialchars($usuario->getUsername());
        ?>

        <div class="alert alert-success">
            <strong>Usuario logueado:</strong> <?= $nombreUsuario ?> <br>
            <strong>Rol:</strong> <?= ucfirst($rol) ?>
        </div>

        <?php if (isset($_SESSION['juegoActivo'])): ?>
            <?php 
                $juego = $_SESSION['juegoActivo'];
                $familia = $juego->getFamilia()->getNombre();
                $inicio = $juego->getFechaInicio()->format('Y-m-d');
                $fin = $juego->getFechaFin()->format('Y-m-d');
            ?>
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white">
                    🕹 Juego Activo
                </div>
                <div class="card-body">
                    <p><strong>Familia:</strong> <?= $familia ?></p>
                    <p><strong>Inicio:</strong> <?= $inicio ?></p>
                    <p><strong>Fin:</strong> <?= $fin ?></p>
                    <p><strong>Preguntas cargadas:</strong> <?= count($juego->getPreguntas()) ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                ⚠️ No hay un juego activo para tu familia actualmente.
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="alert alert-secondary">
            🔒 No has iniciado sesión. <a href="index.php?s=login">Inicia sesión aquí</a>.
        </div>
    <?php endif; ?>
</div>
