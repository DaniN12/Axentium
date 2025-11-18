<?php
$palabras = $_SESSION['glosario'];
?>
<div class="container py-4 ">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Glosario</h1>
    </div>
    <div class="row g-3 mt-3">
        <div class="col-12">
            <p class="text-muted">Consulta los términos técnicos en euskera y sus traducciones al castellano. Puedes usar el índice alfabético para navegar más rápido.</p>
        </div>
    </div>
    <div class="row g-3 mt-3">
        <div class="col-10 col-md-10">
            <div class="card">
                <div class="card-body pt-0">
                    <?php
                    $currentLetter = null;
                    foreach ($palabras as $p):
                        $term = isset($p->palabra_euskera) ? $p->palabra_euskera : '';
                        $first = mb_strtoupper(mb_substr($term, 0, 1));

                        if ($first !== $currentLetter) {
                            $currentLetter = $first;
                            echo "<h5 id='sec-{$currentLetter}' class='fw-bold text-primary mt-4 mb-3 border-bottom pb-1'>" . htmlspecialchars($currentLetter) . "</h5>";
                        }
                    ?>
                        <div class="mb-3">
                            <div class="fw-bold fs-6"><?= htmlspecialchars($p->palabra_euskera) ?></div>
                            <div class="text-secondary"><?= htmlspecialchars($p->palabra_castellano) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-2 col-md-2">
            <div class="card bg-primary text-primary-light">
                <div class="card-body">
                    <nav class="alphabet-nav d-flex flex-column align-items-center text-primary-light">
                        <?php
                        $letters = range('A', 'Z');
                        foreach ($letters as $L):
                            if ($L === 'C' || $L === 'V') continue;
                        ?>
                            <a class="text-primary-light" href="#sec-<?= $L ?>"><?= $L ?></a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>