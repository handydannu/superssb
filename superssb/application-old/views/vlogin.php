<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Admin Panel">
    <meta name="author" content="BIS">
    <link rel="shortcut icon" href="<?= images_uri() ?>favicon.png">

    <title>Login Admin Panel</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />

    <!--Core CSS -->
    <link href="<?= template_uri() ?>bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= template_uri() ?>css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?= template_uri() ?>font-awesome-4.6.3/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?= template_uri() ?>css/style.css" rel="stylesheet">
    <link href="<?= template_uri() ?>css/style-responsive.css" rel="stylesheet" />
    <!-- Gritter Notif -->
    <link rel="stylesheet" type="text/css" href="<?= template_uri() ?>js/gritter/css/jquery.gritter.css" />
</head>

  <body class="login-body">

    <div class="container">
      <?php $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : base64_encode(base_url()) ?>
      <form class="form-signin cmxform" action="<?php echo site_url('/log/in?redirect='.$redirect) ?>" method="POST" id="loginForm">
        <h2 class="form-signin-heading"><img src="<?= images_uri() ?>logo-right.png" alt="Logo" width="250" height="107" /></h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <!-- notif -->
                <?php 
                  $error = validation_errors('<span>','</span>');
                  if (!empty($error)):
                ?>
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Oh snap!<br /></strong><?= $error; ?>.
                </div>
                <?php endif; ?>
                <!-- end notif -->
                <div class="form-group ">
                  <input type="text" class="form-control" name="username" placeholder="Username" autofocus required />
                </div>
                <div class="form-group ">
                  <input type="password" class="form-control" name="password" placeholder="Password" required />
                </div>
                <input type="hidden" name="redirect" value="<?php echo $redirect ?>">

                <label class="checkbox" style="margin-bottom:0 !important;">
                    <span class="pull-right">
                        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                    </span>
                </label>
            </div>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>
    </div>

    <!--Core js-->
    <script src="<?= template_uri() ?>js/jquery.js"></script>
    <script src="<?= template_uri() ?>bs3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?= template_uri() ?>js/jquery.validate.min.js"></script>
    <script src="<?= template_uri() ?>js/validation-init.js"></script>

    <?php $this->load->view('vnotif'); ?>
  </body>
</html>
