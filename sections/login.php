<?php

?>

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h1 class="text-center font-weight-light my-4">Iniciar Sesión</h1>
                </div>
                <label class="text-center">Inicia sesión para continuar</label>
                <div class="card-body">
                    <form action="<?= BASE_URL?>/control/login_controller.php" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="username" name="username" type="text" style="background-color: #717473; border-color: #717473;" />
                            <label for="username">Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" type="password" name="password"  style="background-color: #717473; border-color: #717473;" />
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block"
                                    style="background-color: #FEB06A; color: #1C2120; border-color: #FEB06A;">
                                    <b>Iniciar Sesión</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-center py-3">
                    <div class="small"><a href="registro.html" style="color: #fff; text-decoration: none;">¡Regístrate!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>
<br>
<div id="layoutAuthentication_footer">
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>