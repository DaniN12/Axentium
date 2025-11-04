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
        <h1 class="mt-5 pt-4">Registro</h1>
        <form class="col-12 me-auto w-100 pt-4 mb-5" action="./control/registro_controller.php" method="POST">
            <div class="row g-3">
                <div class="col mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Centro</label>
                <select name="centro" id="centro" class="form-control">
                    <option value="" disabled selected> -- Selecciona un centro -- </option>
                    <?php
                    foreach($centros as $centro){
                    ?>
                        <option value="<?= $centro->getId() ?>"><?= $centro->getNombre() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Ciclo</label>
                <select name="ciclo" id="ciclo" class="form-control">
                    <option value="" disabled selected> -- Selecciona un ciclo -- </option>
                    <?php
                    for ($j = 0; $j <= count($ciclos) - 1; $j++) {
                        $id = $ciclos[$j]->getId();
                        $nombre = $ciclos[$j]->getNombre();
                    ?>
                        <option value="<?= $id ?>"><?= $nombre ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pass">
            </div>
            <div class="mb-3">
                <label for="pass2" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" name="pass2">
            </div>
            <button type="submit" class="btn btn-primary col-12">Registrar</button>
        </form>
    </div>
</div>