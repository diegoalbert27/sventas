<!DOCTYPE html>
<html lang='es'>

<?php include_once '../app/Views/partials/head.php' ?>

<body class="hold-transition login-page">

    <?php
    if (isset($_SESSION['message'])) {
    ?>
    <div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span
                aria-hidden='true'>&times;</span></button>
        <div class='text-center'>
            <?php echo $_SESSION['message']; ?>
        </div>
    </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>System</b>Ventas</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><b>Bienvenido</b></p>

            <form id="form" class="form-horizontal" method="POST" action="login" data-toggle="validator">
                <div class="form-group has-feedback">
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <div class="input-group-text bg-light">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input id="username" type="text" class="form-control" name="username" placeholder="usuario" value=""
                            autofocus required>
                    </div>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div class="text-center help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <div class="input-group-text bg-light">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                            value="" required>
                    </div>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="text-center help-block with-errors"></div>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div>
                    <!-- /.col -->
                    <div class="col-xs-4 col-md">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="text-center mt-3">
                    <small>Copyright &copy; 2022. Todos los Derechos Reservados.</small>
                </div>
            </form>

            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <?php include_once '../app/Views/partials/head.php' ?>
</body>

</html>
