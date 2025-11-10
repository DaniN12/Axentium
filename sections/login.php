<?php

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center">
                    <h1 class="h4 my-2">Iniciar Sesión</h1>
                    <small class="text-muted">Inicia sesión para continuar</small>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL?>/control/login_controller.php" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="username" name="username" type="text" placeholder="usuario" />
                            <label for="username">Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" type="password" name="password" placeholder="••••••" />
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-center">
                    <a href="index.php?s=registro" class="text-decoration-none">¿No tienes cuenta? Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</div>