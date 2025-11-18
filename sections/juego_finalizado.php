<?php
// Comprueba que hay un juego en sesión
if (!isset($_SESSION['juegoActivo'])) {
    header('Location: ' . BASE_URL . 'index.php?s=home');
}
$juego = $_SESSION['juegoActivo'];

?>
<div class="container py-4">
    <div class="card shadow-sm radius-12 p-4 text-center pregunta-animada">

        <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
        <h2 class="text-primary mb-2">Zorionak!</h2>
        <h4 class="mb-3">Has terminado la partida</h4>

        <p class="text-muted">En el juego de esta semana has conseguido:</p>

        <h1 class="text-success fw-bold puntaje-animado">
            <?= $_SESSION['partida']->getPuntuacion() ?> puntos
        </h1>

        <p class="mt-3 text-muted">¡Sigue jugando cada semana para mejorar tu puntuación!</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a class="btn btn-outline-primary" href="<?= BASE_URL ?>control/ranking_controller.php">
                <i class="fas fa-crown me-1"></i> Ver Ranking
            </a>
        </div>
    </div>
</div>