
<?php
require_once __DIR__ . "/../model/repository/CentroRepository.php";
require_once __DIR__ . "/../model/repository/CicloRepository.php";

$centroRepository = new CentroRepository();
$centros = $centroRepository->getCentros();
$cicloRepository = new CicloRepository();
$ciclos = $cicloRepository->getCiclos();

?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h1 class="h4 my-2">Registro</h1>
                </div>
                <div class="card-body">
                    <form action="./control/registro_controller.php" method="POST">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="usuario">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select name="centro" id="centro" class="form-select" placeholder="Selecciona">
                                        <option value="" disabled selected> -- Selecciona un centro -- </option>
                                        <?php foreach($centros as $centro){ ?>
                                            <option value="<?= $centro->getId() ?>"><?= $centro->getNombre() ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="centro">Centro</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select name="ciclo" id="ciclo" class="form-select" placeholder="Selecciona">
                                        <option value="" disabled selected> -- Selecciona un ciclo -- </option>
                                        <?php for ($j = 0; $j <= count($ciclos) - 1; $j++) { $id = $ciclos[$j]->getId(); $nombre = $ciclos[$j]->getNombre(); ?>
                                            <option value="<?= $id ?>"><?= $nombre ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="ciclo">Ciclo</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••">
                                    <label for="pass">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="••••••">
                                    <label for="pass2">Confirmar contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
