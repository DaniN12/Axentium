<?php
// require_once(__DIR__ . '/../config.php');
// require_once(BASE_PATH . "/model/repository/GlosarioRepository.php");
require_once BASE_PATH . '/model/repository/GlosarioRepository.php';


$repo = new GlosarioRepository();
$palabras = $repo->obtenerTodos();
?>

<div class="row g-3 mt-3">
    <div class="col-12">
        <h1 class="h3 mb-0">Glosario Euskera / Castellano</h1>
        <p class="text-muted">Consulta términos y sus traducciones. Usa el índice alfabético para navegar.</p>
    </div>

    <div class="col-2 col-md-2">
        <div class="card">
            <div class="card-body">
                <nav class="alphabet-nav d-flex flex-column align-items-center">
                    <?php
                    $letters = range('A', 'Z');
                    foreach ($letters as $L): ?>
                        <a href="#sec-<?= $L ?>"><?= $L ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </div>
    </div>

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
</div>
