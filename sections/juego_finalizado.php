<?php
// Comprueba que hay un juego en sesión
if (!isset($_SESSION['juegoActivo'])) {
    header('Location: ' . BASE_URL . 'index.php?s=home');
}
$juego = $_SESSION['juegoActivo'];

?>
<div class="container py-3">
    <div class="text-center p-4 pregunta-animada">
        <h2>Zorionak! </h2>
        <h3>Has terminado la partida</h3>
        <p>En el juego de esta semana has conseguido:</p>
        <h3 class="text-success"><?= $_SESSION['partida']->getPuntuacion() ?> puntos</h3>
    </div>
</div>
