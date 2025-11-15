<?php
require_once __DIR__ . "/../control/notificaciones_controller.php";
// $repo = new NotificacionesRepository();
// $notificaciones = $repo->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-3">
    <h1 class="h4 mb-3"><i class="fa-solid fa-bell me-2"></i>Avisos</h1>
    <div class="list-group">
        <?php if (empty($notificaciones)): ?>
            <div class="alert alert-secondary">No tienes notificaciones.</div>
        <?php else: ?>
            <?php foreach ($notificaciones as $n): ?>
                <div class="list-group-item d-flex align-items-center">
                    <i class="fa-solid fa-circle-info text-primary me-2"></i>
                    <div><?= htmlspecialchars($n->getTexto()) ?></div>
                    <small class="ms-auto text-muted">nuevo</small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://kit.fontawesome.com/a2e0b6b52f.js" crossorigin="anonymous"></script>
</body>
</html>