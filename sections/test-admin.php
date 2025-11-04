
<?php
// require_once BASE_PATH . "/config.php";
require_once BASE_PATH . "/model/repository/CentroRepository.php";
require_once BASE_PATH . "/model/repository/CicloRepository.php";

$centroRepository = new CentroRepository();
$centros = $centroRepository->getCentros();
$cicloRepository = new CicloRepository();
$ciclos = $cicloRepository->getCiclos();

?>
<div class="container mt-5">
    <div class="bg-body-tertiary rounded">
        <h1 class="mt-5 pt-4">test bd</h1>
        <p>Página provisional de prueba para testear las llamadas a BD</p>

        <div class="mb-3">
            <form action="<?= BASE_URL ?>control/centro_controller.php" method="POST">
                <input type="hidden" name="action" value="getAll">
                <button type="submit" class="btn btn-primary">Get: Todos los centros</button>
            </form>
        </div>
        <div class="mb-3">
            <form action="<?= BASE_URL ?>control/ciclo_controller.php" method="POST">
                <button type="submit" class="btn btn-primary">Get: Todos los ciclos</button>
            </form>
        </div>
        <form class="me-auto pt-4 mb-5" action="<?= BASE_URL ?>control/centro_controller.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Centro</label>
                <select name="centro" id="centro" class="form-control w-25">
                    <option value="" disabled selected> -- Selecciona un centro -- </option>
                    <?php
                    foreach ($centros as $centro) {
                    ?>
                        <option value="<?= $centro->getId() ?>"><?= $centro->getNombre() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="action" value="getCiclosByCentro">
            <button type="submit" class="btn btn-primary">Get ciclos by Centro</button>
        </form>
        <form class="me-auto pt-4 mb-5" action="<?= BASE_URL ?>control/centro_controller.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Centro</label>
                <select name="centro" id="centro" class="form-control w-25">
                    <option value="" disabled selected> -- Selecciona un centro -- </option>
                    <?php
                    foreach ($centros as $centro) {
                    ?>
                        <option value="<?= $centro->getId() ?>"><?= $centro->getNombre() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="action" value="getFamiliasByCentro">
            <button type="submit" class="btn btn-primary">Get familias by Centro</button>
        </form>
        <form class="me-auto pt-4 mb-5" action="<?= BASE_URL ?>admin/control/juego_controller.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Centro</label>
                <select name="centro" id="centro" class="form-control w-25">
                    <option value="" disabled selected> -- Selecciona un centro -- </option>
                    <?php
                    foreach ($centros as $centro) {
                    ?>
                        <option value="<?= $centro->getId() ?>"><?= $centro->getNombre() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <label for="fecha_inicio">Fecha inicio</label>
            <input type="date" name="fecha_inicio" id="">
            <label for="fecha_fin">Fecha fin</label>
            <input type="date" name="fecha_fin" id="">
            <input type="hidden" name="action" value="crearJuegosByCentro">
            <button type="submit" class="btn btn-primary">Crear juegos para un Centro</button>
        </form>
    </div>
</div>