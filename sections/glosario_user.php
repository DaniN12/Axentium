<?php
require_once(__DIR__ . '/../model/repository/GlosarioRepository.php');
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
                    <nav class="alphabet-nav">
                        <?php 
                        $letters = range('A','Z');
                        foreach ($letters as $L): ?>
                            <a href="#sec-<?= $L ?>"><?= $L ?></a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-10 col-md-10">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Euskera</th>
                                    <th scope="col">Castellano</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $currentLetter = null;
                                foreach ($palabras as $p): 
                                    $term = isset($p->palabra_castellano) ? $p->palabra_castellano : '';
                                    $first = mb_strtoupper(mb_substr($term, 0, 1));
                                    if ($first !== $currentLetter) {
                                        $currentLetter = $first;
                                        echo "<tr class='table-grouped'><td colspan='2' id='sec-{$currentLetter}' class='fw-bold text-primary py-3'>" . htmlspecialchars($currentLetter) . "</td></tr>";
                                    }
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p->palabra_euskera) ?></td>
                                        <td><?= htmlspecialchars($p->palabra_castellano) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
