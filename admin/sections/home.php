<?php
$bd = new AccesoBD();
$conexion = $bd->conexion;
$usuariosRepo = new UsuarioRepository($conexion);
$usuariosRegistrados = $usuariosRepo->getCountUsuarios();
$usuariosActivos = 800;
$partidasRepo = new PartidaRepository($conexion);
$partidasJugadas = $partidasRepo->getCountPartidas();
$rankingUsuarios = $partidasRepo->getAllPuntuaciones();
$rankingCiclos = $partidasRepo->getRankingPorCiclos();
$nuevosUsuariosSemana = $usuariosRepo->getCountNuevosUsuariosSemana();
$partidasEstaSemana = $partidasRepo->getCountPartidasEstaSemana();

$partidasPorSemana = $partidasRepo->getPartidasPorSemana();
$labelsSemanas = array_column($partidasPorSemana, 'semana');
$valoresSemanas = array_column($partidasPorSemana, 'total');

$totalPorFamilia = $partidasRepo->getTotalUsuariosPorFamilia();
$activosPorSemana = $partidasRepo->getUsuariosActivosPorFamiliaPorSemana();

$familias = [];
$semanas = [];
$porcentajes = [];

foreach ($activosPorSemana as $row) {
    $sem = $row['semana'];
    $famId = $row['familiaId'];
    $famName = $row['familia'];
    $activos = (int)$row['usuariosActivos'];

    $familias[$famId] = $famName;
    $semanas[$sem] = true;

    $total = $totalPorFamilia[$famId]['totalUsuarios'];

    $porcentaje = $total > 0 ? round(($activos / $total) * 100, 2) : 0;

    $porcentajes[$famId][$sem] = $porcentaje;
}

// rellenar semanas faltantes con 0
foreach ($familias as $famId => $name) {
    foreach ($semanas as $sem => $_) {
        if (!isset($porcentajes[$famId][$sem])) {
            $porcentajes[$famId][$sem] = 0;
        }
    }
}

$familiasJS = array_values($familias);
$semanasJS = array_keys($semanas);

// generar datasets
$datasetsJS = [];
$opacity = 1.0;

foreach ($familias as $famId => $famName) {
    $datasetsJS[] = [
        "label" => $famName,
        "data" => array_values($porcentajes[$famId]),
    ];
}


?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 text-secondary">Estadísticas</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card h-100 border-primary shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Usuarios Totales</h5>
                    <p class="display-6 fw-bold mb-0"><?= $usuariosRegistrados ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-primary shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Nuevos Usuarios</h5>
                    <p class="display-6 fw-bold mb-0"><?= $nuevosUsuariosSemana ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-secondary shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-secondary">Total Partidas Jugadas</h5>
                    <p class="display-6 fw-bold mb-0"><?= $partidasJugadas ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 border-success shadow-sm rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Partidas Esta Semana</h5>
                    <p class="display-6 fw-bold mb-0"><?= $partidasEstaSemana ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Minimalistas -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-header bg-white fw-bold border-bottom">
                    Partidas por Semana
                </div>
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-header bg-white fw-bold border-bottom">
                    % Partidas por Familia
                </div>
                <div class="card-body">
                    <canvas id="barChartFamily"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Rankings -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-header bg-white fw-bold border-bottom">
                    Ranking Usuarios
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Posición</th>
                                <th>Nombre</th>
                                <th>Ciclo</th>
                                <th>Puntuación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pos = 1;
                            foreach ($rankingUsuarios as $u): ?>
                                <tr>
                                    <td><?= $pos++ ?></td>
                                    <td>
                                        <strong><?= $u['usuario'] ?></strong>
                                    </td>
                                    <td><span class="badge text-bg-secondary"><?= $u['ciclo'] ?></span></td>
                                    <td><?= $u['puntuacion'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm rounded-3 border-light">
                <div class="card-header bg-white fw-bold border-bottom">
                    Ranking Ciclos
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Posición</th>
                                <th>Ciclo</th>
                                <th>Puntuación Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pos = 1;
                            foreach ($rankingCiclos as $c): ?>
                                <tr>
                                    <td><?= $pos++ ?></td>
                                    <td><?= $c['ciclo'] ?></td>
                                    <td><?= $c['puntosTotales'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: <?= json_encode($labelsSemanas) ?>,
            datasets: [{
                label: 'Partidas Jugadas',
                data: <?= json_encode($valoresSemanas) ?>,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#0d6efd',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxBarFamily = document.getElementById('barChartFamily').getContext('2d');

    const semanas = <?= json_encode($semanasJS) ?>;
    const datasets = <?= json_encode($datasetsJS) ?>;

    const colores = [
        'rgba(218, 117, 45, 0.9)',
        'rgba(141, 68, 16, 0.9)',
        'rgba(37, 120, 74, 0.9)',
        'rgba(71, 137, 199, 0.9)'
    ];
    datasets.forEach((ds, i) => {
        ds.backgroundColor = colores[i % colores.length];
        ds.borderColor = colores[i % colores.length];
    });

    const barChartFamily = new Chart(ctxBarFamily, {
        type: 'bar',
        data: {
            labels: semanas,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Porcentaje (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Semana'
                    },
                    stacked: false
                }
            }
        }
    });
</script>

<style>
    /* Minimalista y elegante */
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
</style>