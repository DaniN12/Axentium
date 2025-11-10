<?php
$preguntaRepository = new PreguntaRepository();
$familiaRepository = new FamiliaRepository();
$categoriaRepository = new CategoriaRepository();
$familias = $familiaRepository->getFamilias();
$categorias = $categoriaRepository->getCategorias();

$preguntasGenerales = $preguntaRepository->getPreguntasPorFamilia(null);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Preguntas</h1>

    <div class="text-start mt-4">
        <button id="toggleFormularios" class="btn btn-primary fw-semibold">
            <i class="fa-solid fa-plus me-2"></i> Crear Nuevas Preguntas
        </button>
    </div>

    <div id="formulariosContainer" class="mt-4" style="display: none;">
        <div class="d-flex justify-content-end mb-3">
            <button id="cerrarFormularios" class="btn btn-danger btn-sm fw-semibold">
                <i class="fa-solid fa-xmark me-1"></i> Cerrar
            </button>
        </div>

        <div class="row" id="formulariosPreguntas">
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <i class="fa-solid fa-circle-question me-2"></i> Crear pregunta general
                    </div>

                    <div class="card-body">
                        <form action="<?= BASE_URL ?>admin/control/pregunta_controller.php" method="POST" class="row g-3" enctype="multipart/form-data">

                            <div class="col-12">
                                <label class="form-label fw-semibold">Pregunta</label>
                                <input type="text" name="pregunta" class="form-control" placeholder="Escribe la pregunta" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Categoría</label>
                                <select name="categoria" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona una categoría --</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria->getId() ?>"><?= htmlspecialchars($categoria->getNombre()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 1</label>
                                <input type="text" name="opcion1" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 2</label>
                                <input type="text" name="opcion2" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 3</label>
                                <input type="text" name="opcion3" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Respuesta correcta</label>
                                <select name="correcta" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona la correcta --</option>
                                    <option value="1">Opción 1</option>
                                    <option value="2">Opción 2</option>
                                    <option value="3">Opción 3</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Imagen (opcional)</label>
                                <input type="file" name="img" class="form-control" accept="image/*">
                            </div>

                            <div class="col-md-6 d-grid">
                                <input type="hidden" name="action" value="crearPreguntaGeneral">
                                <button type="submit" class="btn btn-success fw-semibold">
                                    <i class="fa-solid fa-plus me-1"></i> Crear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <i class="fa-solid fa-people-group me-2"></i> Crear pregunta por familia
                    </div>

                    <div class="card-body">
                        <form action="<?= BASE_URL ?>admin/control/pregunta_controller.php" method="POST" class="row g-3">

                            <div class="col-12">
                                <label class="form-label fw-semibold">Pregunta</label>
                                <input type="text" name="pregunta" class="form-control" placeholder="Escribe la pregunta" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Familia</label>
                                <select name="familia" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona una familia --</option>
                                    <?php foreach ($familias as $familia): ?>
                                        <option value="<?= $familia->getId() ?>"><?= htmlspecialchars($familia->getNombre()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 1</label>
                                <input type="text" name="opcion1" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 2</label>
                                <input type="text" name="opcion2" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Opción 3</label>
                                <input type="text" name="opcion3" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Respuesta correcta</label>
                                <select name="correcta" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona la correcta --</option>
                                    <option value="1">Opción 1</option>
                                    <option value="2">Opción 2</option>
                                    <option value="3">Opción 3</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Imagen (opcional)</label>
                                <input type="file" name="img" class="form-control" accept="image/*">
                            </div>

                            <div class="col-md-6 d-grid">
                                <input type="hidden" name="action" value="crearPreguntaGeneral">
                                <button type="submit" class="btn btn-success fw-semibold">
                                    <i class="fa-solid fa-plus me-1"></i> Crear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-5">Preguntas Generales</h2>

    <div class="card mt-3 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <i class="fa-solid fa-question me-1"></i> Preguntas generales
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Pregunta</th>
                            <th>Opción 1</th>
                            <th>Opción 2</th>
                            <th>Opción 3</th>
                            <th>Correcta</th>
                            <th>Categoria</th>
                            <th>Usadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($preguntasGenerales)) { ?>
                            <?php foreach ($preguntasGenerales as $pregunta) { ?>
                                <tr>
                                    <td><?= $pregunta->getId() ?></td>
                                    <td><?= htmlspecialchars($pregunta->getPregunta()) ?></td>
                                    <td><?= htmlspecialchars($pregunta->getOpcion1()) ?></td>
                                    <td><?= htmlspecialchars($pregunta->getOpcion2()) ?></td>
                                    <td><?= htmlspecialchars($pregunta->getOpcion3()) ?></td>
                                    <td><?= htmlspecialchars($pregunta->getCorrecta()) ?></td>
                                    <td><?= $pregunta->getCategoria() ? htmlspecialchars($pregunta->getCategoria()->getNombre()) : '-' ?></td>
                                    <td class="text-center"><?= $pregunta->getUsada() ? '✅' : '⬜' ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-circle-info me-2"></i>
                                    No hay preguntas generales.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    // 2. Preguntas por familia
    foreach ($familias as $familia) :
        $preguntas = $preguntaRepository->getPreguntasPorFamilia($familia->getId());
    ?>
        <h2 class="mt-5"><?= htmlspecialchars($familia->getNombre()) ?></h2>
        <div class="card mt-2 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <i class="fa-solid fa-question me-1"></i> Preguntas de <?= htmlspecialchars($familia->getNombre()) ?>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Pregunta</th>
                                <th>Opción 1</th>
                                <th>Opción 2</th>
                                <th>Opción 3</th>
                                <th>Correcta</th>
                                <th>Usada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($preguntas)) { ?>
                                <?php foreach ($preguntas as $pregunta) { ?>
                                    <tr>
                                        <td><?= $pregunta->getId() ?></td>
                                        <td><?= htmlspecialchars($pregunta->getPregunta()) ?></td>
                                        <td><?= htmlspecialchars($pregunta->getOpcion1()) ?></td>
                                        <td><?= htmlspecialchars($pregunta->getOpcion2()) ?></td>
                                        <td><?= htmlspecialchars($pregunta->getOpcion3()) ?></td>
                                        <td><?= htmlspecialchars($pregunta->getCorrecta()) ?></td>
                                        <td class="text-center"><?= $pregunta->getUsada() ? '✅' : '⬜' ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fa-solid fa-circle-info me-2"></i>
                                        No hay preguntas para esta familia.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>