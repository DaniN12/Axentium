<?php
require_once __DIR__ . "/../../control/notificaciones_controller.php";
$bd = new AccesoBD();
$repo = new NotificacionesRepository($bd->conexion);
$notificaciones = $repo->getAll();
?>

<div class="container py-3">
    <h1 class="h4 mb-3"><i class="fa-solid fa-bell me-2"></i>Gestión de Notificaciones</h1>
    <p class="mb-5">Desde este panel puedes enviar notificaciones a todos los usuarios de la aplicación.</p>
    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] === 'creada'): ?>
            <div class="alert alert-success">Notificación creada correctamente.</div>
        <?php elseif ($_GET['msg'] === 'eliminada'): ?>
            <div class="alert alert-danger">Notificación eliminada correctamente.</div>
        <?php endif; ?>
    <?php endif; ?>

    <form method="post" action="" class="mb-5">
        <div class="mb-3">
            <label for="texto" class="form-label text-primary">Texto de la notificación</label>
            <input type="text" name="texto" id="texto" class="form-control" required placeholder="Introduce aquí el contenido de la notificación">
        </div>
        <button type="submit" name="enviar" class="btn btn-primary">
            <i class="fa-solid fa-paper-plane me-2"></i>Enviar Notificación
        </button>
    </form>

    <hr>

    <h2 class="h5 mt-5">Notificaciones existentes</h2>
    <ul class="list-group">
        <?php if (empty($notificaciones)): ?>
            <li class="list-group-item text-muted">No hay notificaciones aún.</li>
        <?php else: ?>
            <?php foreach ($notificaciones as $n): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($n->getTexto()) ?>
                    <a href="/Axentium/control/notificaciones_controller.php?delete=<?= $n->getId() ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('¿Eliminar esta notificación?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
