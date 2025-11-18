<?php
// home.php
// require_once BASE_PATH . '/model/Rol.class.php';
// require_once BASE_PATH . '/model/Ciclo.class.php';
// require_once BASE_PATH . '/model/Familia.class.php';
// require_once BASE_PATH . '/model/Usuario.class.php';
// require_once BASE_PATH . '/model/Juego.class.php';
$msg = $_GET['msg'] ?? '';
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'index.php?s=login');
}
?>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 mb-2">Kaixo, <?= htmlspecialchars($_SESSION['usuario']->getUsername()) ?>!</h1>
    </div>

    <section class="mb-5 py-3 px-3 bg-white radius-12">
        <h2 class="h5 mb-2 text-primary-dark">
            <i class="fas fa-gamepad me-2"></i> Juego de la semana
        </h2>
        <hr style="border-top: 2px solid var(--color-primary); margin-left:0;">
        <?php
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'index.php?s=login');
        } else {
            $usuario = $_SESSION['usuario'];
            $msg = $_GET['msg'] ?? '';

            // Mensajes de estado
            if ($msg === 'none') {
                echo '<p class="text-dark">No hay un juego activo para tu familia actualmente.</p>';
            } elseif ($msg === 'jugado') {
                echo '<p class="text-dark">¡Ya has jugado a este juego!</p>';
            } elseif (isset($_SESSION['juegoActivo'])) {
                $juego = $_SESSION['juegoActivo'];
                $familia = $juego->getFamilia()->getNombre();
                $inicio = $juego->getFechaInicio()->format('d M Y');
                $fin = $juego->getFechaFin()->format('d M Y');
                $preguntas = count($juego->getPreguntas());
        ?>
                <p class="text-dark"><strong>
                    ¡Hay un juego disponible para ti!</strong>
                </p>
                <p class="text-dark">
                    Responde correctamente 10 preguntas en el menor tiempo posible para obtener la mayor puntuación.
                </p>
                <div class="d-grid gap-2 mt-3">
                    <a href="<?= BASE_URL ?>control/juego_controller.php" class="btn btn-primary btn-lg text-white">
                        <i class="fas fa-play me-1"></i> Jugar ahora
                    </a>
                </div>
        <?php
            } else {
                echo '<p class="text-dark">No hay juegos activos esta semana.</p>';
            }
        }
        ?>
    </section>

    <section class="mb-5">
        <h2 class="h5 mb-2 text-primary-dark"><i class="fas fa-book me-2"></i>Sigue aprendiendo</h2>
        <p>Visita la sección de <strong><a href="<?= BASE_URL ?>control/glosario_controller.php" class="text-dark">glosario</a></strong> para aprender más términos en euskera.</p>
    </section>

    <section class="mb-5">
        <h2 class="h5 mb-2 text-primary-dark">
            <i class="fas fa-crown me-2"></i> Ranking
        </h2>
        <p>
            Consulta quiénes están liderando la puntuación de la semana y compite para estar en lo más alto.
        </p>
    </section>
</div>