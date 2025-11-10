<?php
// Comprueba que hay un juego en sesión
if (!isset($_SESSION['juegoActivo'])) {
    header('Location: ' . BASE_URL . 'index.php?s=home');
}
$juego = $_SESSION['juegoActivo'];
$preguntas = $juego->getPreguntas();
$preguntasJS = [];
foreach ($preguntas as $p) {
    $preguntasJS[] = [
        'pregunta' => $p->getPregunta(),
        'imagen' => $p->getImg() ?: null,
        'respuestas' => [
            $p->getOpcion1(),
            $p->getOpcion2(),
            $p->getOpcion3()
        ],
        'correcta' => intval($p->getCorrecta()) - 1 // tu modelo empieza en 1
    ];
}
?>
<!-- <div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0"><i class="fa-solid fa-gamepad me-2"></i>Juego semanal</h1>
        <span class="badge text-bg-secondary">00:30</span>
    </div>

    <div class="progress mb-3" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" style="width: 20%">1 / 5</div>
    </div>

    <div class="card">
        <div class="card-body text-center">
            <h2 class="h5">Traduce:</h2>
            <div class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center rounded mb-3">
                <div class="fs-3 text-muted">"Mendi"</div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary">Montaña</button>
                <button class="btn btn-outline-primary">Río</button>
                <button class="btn btn-outline-primary">Ciudad</button>
            </div>
        </div>
    </div>

</div> -->
<div class="container py-4" id="juego-container">
    <div class="text-center">
        <div class="badge bg-secondary fs-5" id="temporizador">⏱ 60</div>
        <div class="text-muted mt-1" id="texto-progreso">Pregunta 1 / <?= count($preguntasJS) ?></div>
        <div class="progress mt-1">
            <div class="progress-bar bg-success" id="barra-progreso" role="progressbar" style="width: 0%;"></div>
        </div>
    </div>

    <!-- Pregunta + Imagen -->
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <h5 class="fw-bold mb-3" id="texto-pregunta">Cargando pregunta...</h5>

            <div id="imagen-container" class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center rounded mb-3">
                <img id="imagen-pregunta" class="img-fluid rounded" style="max-height:200px; display:none;" alt="Imagen pregunta">
            </div>

            <!-- Respuestas fijas en HTML -->
            <div id="respuestas" class="d-grid gap-2">
                <button class="btn btn-outline-primary boton-respuesta" data-index="0">Opción 1</button>
                <button class="btn btn-outline-primary boton-respuesta" data-index="1">Opción 2</button>
                <button class="btn btn-outline-primary boton-respuesta" data-index="2">Opción 3</button>
            </div>
        </div>
    </div>
</div>
<form id="form-puntuacion" method="POST" action="<?= BASE_URL ?>control/puntuacion_controller.php" style="display:none;">
    <input type="hidden" name="puntuacion" id="input-puntuacion" value="0">
    <input type="hidden" name="respuestas" id="input-respuestas" value="">
</form>

<script>
    window.preguntas = <?= json_encode($preguntasJS, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>;
    window.baseUrl = "<?= BASE_URL ?>";
</script>