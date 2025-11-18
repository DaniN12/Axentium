<?php
require_once __DIR__ . "/../model/repository/CentroRepository.php";
require_once __DIR__ . "/../model/repository/CicloRepository.php";
$bd = new AccesoBD();
$conexion = $bd->conexion;
$centroRepository = new CentroRepository($conexion);
$centros = $centroRepository->getCentros();
$cicloRepository = new CicloRepository($conexion);
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
                                    <small class="text-danger d-none" id="error-username"></small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                                    <label for="email">Email</label>
                                    <small class="text-danger d-none" id="error-email"></small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select name="centro" id="centro" class="form-select" placeholder="Selecciona">
                                        <option value="" disabled selected> -- Selecciona un centro -- </option>
                                        <?php foreach ($centros as $centro) { ?>
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

                                    </select>
                                    <label for="ciclo">Ciclo</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••">
                                    <label for="pass">Confirmar contraseña</label>
                                    <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-secondary toggle-pass"
                                        data-target="pass" aria-label="Mostrar contraseña">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <small class="text-danger d-none" id="error-pass"></small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="••••••">
                                    <label for="pass2">Confirmar contraseña</label>
                                    <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-secondary toggle-pass"
                                        data-target="pass2" aria-label="Mostrar contraseña">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <small class="text-danger d-none" id="error-pass2"></small>
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