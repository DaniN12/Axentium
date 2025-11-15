<?php
// home.php
// require_once BASE_PATH . '/model/Rol.class.php';
// require_once BASE_PATH . '/model/Ciclo.class.php';
// require_once BASE_PATH . '/model/Familia.class.php';
// require_once BASE_PATH . '/model/Usuario.class.php';
// require_once BASE_PATH . '/model/Juego.class.php';
$msg = $_GET['msg'] ?? '';
if(!isset($_SESSION['usuario'])){
    header('Location: ' . BASE_URL . 'index.php?s=login');
}
?>

<div class="container py-3">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Kaixo, <?=$_SESSION['usuario']->getUsername() ?>!</h1>
        <!-- <span class="badge text-bg-light">Zona de usuario</span> -->
    </div>

    <?php
    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . BASE_URL . 'index.php?s=login');
    } else {
        $usuario = $_SESSION['usuario'];
        $rol = strtolower($usuario->getRol()->getRolName());
        $nombreUsuario = htmlspecialchars($usuario->getUsername());
    ?>

        <?php
        // Mensajes específicos
        if ($msg === 'none') {
            echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="fas fa-solid fa-circle-info me-2"></i>
                <div>No hay un juego activo para tu familia actualmente.</div>
              </div>';
        } elseif ($msg === 'jugado') {
            echo '<div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="fas fa-solid fa-circle-check me-2"></i>
                <div>¡Ya has jugado a este juego!</div>
              </div>';
        } ?>
        
        <?php if (isset($_SESSION['juegoActivo']) && $msg == '') {

            $juego = $_SESSION['juegoActivo'];
            $familia = $juego->getFamilia()->getNombre();
            $inicio = $juego->getFechaInicio()->format('Y-m-d');
            $fin = $juego->getFechaFin()->format('Y-m-d');
        ?>
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-solid fa-gamepad me-1"></i> Juego activo
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-12 col-md-4"><strong>Familia:</strong> <?= $familia ?></div>
                        <div class="col-6 col-md-4"><strong>Inicio:</strong> <?= $inicio ?></div>
                        <div class="col-6 col-md-4"><strong>Fin:</strong> <?= $fin ?></div>
                        <div class="col-12"><strong>Preguntas cargadas:</strong> <?= count($juego->getPreguntas()) ?></div>
                    </div>
                    <div class="d-grid mt-3">
                        <a href="<?= BASE_URL ?>control/juego_controller.php" class="btn btn-primary">
                            <i class="fas fa-solid fa-play me-1"></i> Jugar ahora
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }?> 
        <div class="card border-success mb-3">
                <div class="card-header bg-secondary text-white">
                    <i class="fas fa-solid fa-book me-1"></i> Sigue aprendiendo
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-12">
                            <p>Visita la sección de <strong>glosario</strong> para aprender más términos en euskera que te serán útiles en tu ciclo formativo.</p>
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                    </div>
                </div>
            </div>
        <?php
    } ?>
</div>