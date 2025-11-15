<?php
$bd = new AccesoBD();
$repo = new GlosarioRepository($bd->conexion);
$palabras = $repo->obtenerTodos();
?>

<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Glosario Euskera / Castellano (Admin)</h1>
        <a href="../control/exportar_excel.php" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-file-excel me-1"></i> Exportar a Excel</a>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="post" action="<?= BASE_URL ?>admin/control/glosario_controller.php">
                <div class="col-12 col-md-5">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="palabra_eu" name="palabra_euskera" placeholder="Euskera" required>
                        <label for="palabra_eu">Palabra en Euskera</label>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="palabra_es" name="palabra_castellano" placeholder="Castellano" required>
                        <label for="palabra_es">Palabra en Castellano</label>
                    </div>
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="submit" name="agregar" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Euskera</th>
                            <th>Castellano</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($palabras as $p): ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" form="form-<?= $p->id ?>" name="palabra_euskera" value="<?= htmlspecialchars($p->palabra_euskera) ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" form="form-<?= $p->id ?>" name="palabra_castellano" value="<?= htmlspecialchars($p->palabra_castellano) ?>">
                                </td>
                                <td class="text-end">
                                    <form id="form-<?= $p->id ?>" method="post" action="<?= BASE_URL ?>admin/control/glosario_controller.php">
                                        <input type="hidden" name="id" value="<?= $p->id ?>">
                                        <button type="submit" name="editar" class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-floppy-disk"></i></button>
                                        <button type="submit" name="eliminar" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta palabra?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>