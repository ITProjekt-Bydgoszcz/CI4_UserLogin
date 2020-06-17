<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= $title ?></title>
    <!-- Favicon-->
    <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="./assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><?= $intranet ?></a>
            <small><?= $mini_intrnet ?></small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" >
                  <?php if(isset($validation)): ?>
                    <div class="body bg-red">
                      <?= $validation->listErrors() ?>
                    </div>
                  <?php endif; ?>

                  <?php if(isset($blad_logowania)): ?>
                    <div class="body bg-red">
                     <?= $blad_logowania ?>
                    </div>
                  <?php endif; ?>

                  <hr>
                    <div class="msg"><?= $intro ?></div>
                    <?= csrf_field() ?>
                    <?= csrf_meta() ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="email" value="<?= esc(set_value('username')) ?>" placeholder="Podaj Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Hasło" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme"><?= $zapamietaj ?></label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit"><?= $zaloguj ?></button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <!-- <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div> -->
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html"><?= $przypomnij_haslo ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="./assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="./assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="./assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="./assets/js/admin.js"></script>
    <script src="./assets/js/pages/examples/sign-in.js"></script>
</body>

</html>
