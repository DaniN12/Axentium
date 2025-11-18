<?php
$bd = new AccesoBD();
$conexion = $bd->conexion;

$centroRepository = new CentroRepository($conexion);
$centros = $centroRepository->getCentros();
$cicloRepository = new CicloRepository($conexion);
$ciclos = $cicloRepository->getCiclos();
$juegoRepository = new JuegoRepository($conexion);
$juegosActivos = $juegoRepository->getJuegosPorEstado('activos');
$proximosJuegos = $juegoRepository->getJuegosPorEstado('proximos');
$juegosPasados = $juegoRepository->getJuegosPorEstado('pasados');


?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Juegos</h1>
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold"><i class="fas fa-solid fa-gamepad me-2"></i> Crear juegos</span>
        </div>

        <div class="card-body">
            <form action="<?= BASE_URL ?>admin/control/juego_controller.php" method="POST" class="row g-3 align-items-end">
                <!-- Selector de Centro -->
                <div class="col-md-4">
                    <label for="centro" class="form-label fw-semibold">Centro</label>
                    <select name="centro" id="centro" class="form-select" required>
                        <option value="" disabled selected>-- Selecciona un centro --</option>
                        <?php foreach ($centros as $centro): ?>
                            <option value="<?= $centro->getId() ?>"><?= htmlspecialchars($centro->getNombre()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Fecha inicio -->
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label fw-semibold">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                </div>

                <!-- Fecha fin -->
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label fw-semibold">Fecha fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                </div>

                <!-- Botón -->
                <div class="col-md-2 d-grid">
                    <input type="hidden" name="action" value="crearJuegosByCentro">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="fas fa-solid fa-plus me-1"></i> Crear
                    </button>
                </div>

            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold"><i class="fas fa-solid fa-gamepad me-1"></i> Juegos activos</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Familia</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th class="text-center">Preguntas</th>
                            <th class="text-center">Partidas jugadas</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($juegosActivos)): ?>
                            <?php foreach ($juegosActivos as $juego): ?>
                                <tr>
                                    <td><?= htmlspecialchars($juego->getFamilia()->getNombre()) ?></td>
                                    <td><?= $juego->getFechaInicio()->format('Y-m-d') ?></td>
                                    <td><?= $juego->getFechaFin()->format('Y-m-d') ?></td>
                                    <td class="text-center"><?= count($juego->getPreguntas()) ?></td>
                                    <td class="text-center"><?= $juego->getPartidasJugadas() ?></td>
                                    <td class="text-end">
                                        <a href="<?= BASE_URL ?>admin/control/juego_controller.php?action=eliminar&id=<?= $juego->getId() ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este juego?');">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-solid fa-circle-info me-2"></i>
                                    No hay juegos activos en este momento.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4 g-4">
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-solid fa-calendar me-1"></i> Próximos juegos</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Familia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Preguntas</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proximosJuegos)): ?>
                                <?php foreach ($proximosJuegos as $juego): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($juego->getFamilia()->getNombre()) ?></td>
                                        <td><?= $juego->getFechaInicio()->format('Y-m-d') ?></td>
                                        <td><?= $juego->getFechaFin()->format('Y-m-d') ?></td>
                                        <td class="text-center"><?= count($juego->getPreguntas()) ?></td>
                                        <td class="text-end">
                                            <a href="<?= BASE_URL ?>admin/control/juego_controller.php?action=editar&id=<?= $juego->getId() ?>"
                                                class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-solid fa-pen"></i>
                                            </a>
                                            <a href="<?= BASE_URL ?>admin/control/juego_controller.php?action=eliminar&id=<?= $juego->getId() ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Seguro que deseas eliminar este juego?');">
                                                <i class="fas fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-solid fa-circle-info me-2"></i>
                                        No hay juegos programados en este momento.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-solid fa-calendar me-1"></i> Juegos anteriores</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Familia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Preguntas</th>
                                <th>Partidas jugadas</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($juegosPasados)): ?>
                                <?php foreach ($juegosPasados as $juego): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($juego->getFamilia()->getNombre()) ?></td>
                                        <td><?= $juego->getFechaInicio()->format('Y-m-d') ?></td>
                                        <td><?= $juego->getFechaFin()->format('Y-m-d') ?></td>
                                        <td class="text-center"><?= count($juego->getPreguntas()) ?></td>
                                        <td class="text-center"><?= $juego->getPartidasJugadas() ?></td>
                                        <td class="text-end">
                                            <a href="<?= BASE_URL ?>admin/control/juego_controller.php?action=eliminar&id=<?= $juego->getId() ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Seguro que deseas eliminar este juego?');">
                                                <i class="fas fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-solid fa-circle-info me-2"></i>
                                        No hay juegos anteriores
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>