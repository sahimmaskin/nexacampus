<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <title><?= COMPANY_NAME ?> - <?= 'Admin Login' ?> </title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/logo/') ?>favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/bootstrap/css/bootstrap.ltr.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/highlight.js/styles/github.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/simplebar/simplebar.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/quill/quill.snow.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/air-datepicker/css/datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/datatables/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>vendor/fullcalendar/main.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>css/style.css" />
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-97489509-8');
    </script>
</head>

<body>
    <div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
        <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger text-center alert-dismissible fade show text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <form method="post" autocomplete="off" action="<?= base_url('admin/login') ?>">
                    <?= csrf_field() ?>
                    <h1 class="mb-0 fs-3"><?= $title ?></h1>
                    <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">Log in to your account to continue.</div>
                    <div class="mb-4">
                        <label class="form-label">Email Address</label>
                        <input type="text" name="login_id" class="form-control form-control-lg" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" />
                    </div>
                    <div class="mb-4 row py-2 flex-wrap">
                        <div class="col-auto me-auto">
                            <label class="form-check mb-0">
                                <input type="checkbox" class="form-check-input" name="remember"/>
                                <span class="form-check-label">Remember me</span>
                            </label>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <a href="auth-forgot-password.html">Forgot password?</a>
                        </div>
                    </div>
                    <div><button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button></div>
                </form>
            </div>
            <div class="sa-divider sa-divider--has-text">
                <div class="sa-divider__text">Or continue with</div>
            </div>
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <div class="d-flex flex-wrap me-n3 mt-n3"><button type="button"
                        class="btn btn-secondary flex-grow-1 me-3 mt-3">Google</button><button type="button"
                        class="btn btn-secondary flex-grow-1 me-3 mt-3">Facebook</button><button type="button"
                        class="btn btn-secondary flex-grow-1 me-3 mt-3">Twitter</button></div>
                <div class="form-group mb-0 mt-4 pt-2 text-center text-muted">
                    Don't have an account? <a href="<?= base_url('admin/sign-up') ?>">Sign up</a>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/highlight.js/highlight.pack.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/quill/quill.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/air-datepicker/js/datepicker.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/air-datepicker/js/i18n/datepicker.en.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/fontawesome/js/all.min.js" data-auto-replace-svg="" async=""></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/chart.js/chart.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/datatables/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/nouislider/nouislider.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>vendor/fullcalendar/main.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>js/stroyka.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>js/custom.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>js/calendar.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>js/demo.js"></script>
    <script src="<?php echo base_url('assets/admin/') ?>js/demo-chart-js.js"></script>
</body>

</html>