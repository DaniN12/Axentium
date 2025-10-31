<?php
require_once __DIR__ . "/../model/repository/CentroRepository.php";
require_once __DIR__ . "/../model/repository/CicloRepository.php";

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
            <form action="../control/centro_controller.php" method="POST">
                <button type="submit" class="btn btn-primary">Get: Todos los centros</button>
            </form>
        </div>
        <div class="mb-3">
            <form action="../control/ciclo_controller.php" method="POST">
                <button type="submit" class="btn btn-primary">Get: Todos los ciclos</button>
            </form>
        </div>
        <!-- Sin implementar esto -->
        <form class="col-12 me-auto w-100 pt-4 mb-5" action="./admin/control/juego_controller.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Centro</label>
                <select name="centro" id="centro" class="form-control">
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
            <button type="submit" class="btn btn-primary col-12">Crear juego</button>
        </form>
    </div>
</div>