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

<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 mb-2">
            <!-- <i class="fas fa-trophy me-2"></i>  -->
            Ranking
        </h1>
    </div>

    <!-- MI POSICIÓN -->
    <?php if ($miPosicion) { ?>
        <div class="card shadow-sm radius-12 mb-4 border-0 bg-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="fw-semibold">
                    <span class="text-primary">Tu posición:</span> #<?= $miPosicion ?>
                </div>
                <div class="fw-semibold">
                    <span class="text-primary">Puntos:</span> <?= $miPuntuacion ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="card shadow-sm radius-12 mb-4 border-0 bg-white">
            <div class="card-body text-center text-muted">
                Aún no tienes puntuación registrada.
            </div>
        </div>
    <?php } ?>

    <!-- TABLA -->
    <div class="card shadow-sm radius-12 border-0 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr style="background-color: var(--color-primary-light, #f5f7ff);">
                            <th class="py-3">#</th>
                            <th class="py-3">Usuario</th>
                            <th class="py-3">Puntuación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pos = 1;
                        foreach ($ranking as $fila):

                            // Clases para top 3
                            $rowClass = '';
                            if ($pos == 1) $rowClass = 'top1';
                            elseif ($pos == 2) $rowClass = 'top2';
                            elseif ($pos == 3) $rowClass = 'top3';
                        ?>
                            <tr class="<?= $rowClass ?>">
                                <td class="fw-bold"><?= $pos ?></td>
                                <td><?= htmlspecialchars($fila['usuario']) ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($fila['puntuacion']) ?></td>
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
