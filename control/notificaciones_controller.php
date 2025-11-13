<?php
require_once __DIR__ . "/../model/repository/NotificacionesRepository.php";

$repo = new NotificacionesRepository();

// Crear notificación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['texto'])) {
    $texto = trim($_POST['texto']);
    if (!empty($texto)) {
        $repo->add($texto);
    }
    // Redirige al panel de admin
    header("Location: /Axentium/admin/index.php?s=notificaciones_admin");
    exit;
}

// Eliminar notificación
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id > 0) {
        $repo->delete($id);
    }
    // Redirige al panel de admin
    header("Location: /Axentium/admin/index.php?s=notificaciones_admin");
    exit;
}
?>
