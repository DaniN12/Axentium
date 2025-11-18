<?php
require_once __DIR__ . "/../control/notificaciones_controller.php";
$bd = new AccesoBD();
$conexion = $bd->conexion;
$repo = new NotificacionesRepository($conexion);
$notificaciones = $repo->getAll();
?>

<div class="container py-4">

    <div class="mb-4">
        <h1 class="h3 mb-2">
            <!-- <i class="fas fa-bell text-primary me-2"></i> -->
            Avisos
        </h1>
    </div>

    <!-- Si no hay notificaciones -->
    <?php if (empty($notificaciones)): ?>
        <div class="card shadow-sm radius-12 border-0 bg-white mb-4">
            <div class="card-body text-center text-muted py-4">
                No tienes notificaciones.
            </div>
        </div>

    <?php else: ?>

        <div class="card shadow-sm radius-12 border-0">
            <div class="list-group list-group-flush">

                <?php foreach ($notificaciones as $n): ?>
                    <div class="list-group-item d-flex align-items-start py-3">

                        <i class="fa-solid fa-circle-info text-primary me-3 mt-1"></i>

                        <div class="flex-grow-1">
                            <div class="fw-semibold">
                                <?= htmlspecialchars($n->getTexto()) ?>
                            </div>
                        </div>

                        <small class="text-muted ms-3">
                            <?= date("d/m/Y", strtotime($n->getFecha())) ?>
                        </small>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

</div>
