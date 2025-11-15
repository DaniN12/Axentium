<?php
$bd = new AccesoBD();
$usuarioRepository = new UsuarioRepository($bd->conexion);

$totalUsuarios = $usuarioRepository->getAllUsuarios();
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Usuarios</h1>

    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <i class="fa-solid fa-users me-1"></i> Lista de usuarios
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Ciclo</th>
                            <th>Centro</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($totalUsuarios)) {?>
                            <?php foreach ($totalUsuarios as $usuario) { ?>
                                <tr>
                                    <td><?= $usuario->getId() ?></td>
                                    <td><?= htmlspecialchars($usuario->getUsername()) ?></td>
                                    <td><?= htmlspecialchars($usuario->getMail()) ?></td>
                                    <td><?= htmlspecialchars($usuario->getRol()->getRolName()) ?></td>
                                    <td><?= htmlspecialchars($usuario->getCiclo()->getNombre()) ?></td>
                                    <td><?= htmlspecialchars($usuario->getCentro()->getNombre()) ?></td>
                                    <td class="text-end">
                                        <?php if ($usuario->getRol()->getRolId() == UsuarioRepository::ROL_USUARIO) { ?>
                                        <!-- TO-DO: Implementar edición -->
                                        <!-- <a href="<?= BASE_URL ?>admin/control/usuario_controller.php?action=editar&id=<?= $usuario->getId() ?>"
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen"></i>
                                        </a> -->
                                        <a href="<?= BASE_URL ?>admin/control/usuario_controller.php?action=eliminar&id=<?= $usuario->getId() ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }; ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-circle-info me-2"></i>
                                    No hay usuarios que mostrar.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
