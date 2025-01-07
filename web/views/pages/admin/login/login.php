<div class="login-page" cz-shortcut-listen="true">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <h3><b>Administradores</b></h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Inicia sesión para comenzar tu sesión.</p>

                <form method="post" class="needs-validation" novalidate>

                    <div class="input-group mb-3">
                        <input onchange="validateJS(event,'email')" type="email" class="form-control" placeholder="Email" name="loginAdminEmail" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback">Campo inválido</div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="loginAdminPass" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback">Campo inválido</div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" onchange="rememberEmail(event)">
                                <label for="remember"
                                
                                    Recordarme
                                </label>
                            </div>
                        </div>


                        <div class="col-4">
                            <button type="submit" class="btn btn-default templateColor btn-block">Ingresar</button>
                        </div>

                        <?php

                        require_once "controllers/admins.controller.php";
                        $login = new AdminsController();
                        $login -> login();

                        ?>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">Recordar Contraseña</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>