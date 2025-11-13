<?php
?>
<div class="container py-3">
    <h1 class="h4 mb-3"><i class="fa-solid fa-trophy me-2"></i>Ranking</h1>
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
                        <?php for ($i=1; $i<=10; $i++): ?>
                            <tr class="<?php echo $i <= 3 ? 'table-warning' : '';?>">
                                <td class="fw-semibold"><?= $i ?></td>
                                <td>Usuario <?= $i ?></td>
                                <td><?= 1000 - $i*10 ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="d-flex justify-content-between">
                <span>Tu posición:</span>
                <span>#—</span>
            </div>
        </div>
    </div>
</div>
