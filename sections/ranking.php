<?php
$ranking = $_SESSION['ranking'] ?? [];
$miPosicion = null;
$miPuntuacion = 0;
$usuarioActual = $_SESSION['usuario'];
foreach ($ranking as $index => $fila) {
    if ($usuarioActual && $fila['usuarioId'] == $usuarioActual->getId()) {
        $miPosicion = $index + 1;
        $miPuntuacion = $fila['puntuacion'];
        break;
    }
}
?>
<div class="container py-3">
    <h1 class="h4 mb-3"><i class="fas fa-solid fa-trophy me-2"></i>Ranking</h1>
    <?php if ($miPosicion){ ?>
        <div class="alert alert-info d-flex justify-content-between align-items-center shadow-sm rounded-3 mb-3">
            <div><strong>Tu posición:</strong> #<?= $miPosicion ?></div>
            <div><strong>Puntos:</strong> <?= $miPuntuacion ?></div>
        </div>
    <?php } else { ?>
        <div class="alert alert-secondary text-center shadow-sm rounded-3 mb-3">
            Aún no tienes puntuación registrada.
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Puntuación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pos = 1;
                        foreach ($ranking as $fila): ?>
                            <tr class="<?= $pos <= 3 ? 'table-warning' : '' ?>">
                                <td class="fw-semibold"><?= $pos ?></td>
                                <td><?= htmlspecialchars($fila['usuario']) ?></td>
                                <td><?= htmlspecialchars($fila['puntuacion']) ?></td>
                            </tr>
                        <?php
                            $pos++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>