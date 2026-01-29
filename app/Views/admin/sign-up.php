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
        <div class="card w-50x flex-grow-1 flex-sm-grow-0 m-sm-auto">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger text-center">
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
            <div class="card-body p-sm-5 m-sm-3 flex-grow-1">
                <form method="post" action="" autocomplete="off" action="<?= base_url('admin/login') ?>">
                    <?= csrf_field() ?>
                    <h1 class="mb-2 fs-3"><?= $title ?></h1>
                    <p class="text-muted mb-4">
                        Create an account to manage your school digitally.
                    </p>

                    <div class="mb-4">
                        <label class="form-label">
                            School Name: <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="school_name"
                            class="form-control form-control-lg"
                            placeholder="School Name"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">
                                    Email: <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email"
                                    class="form-control form-control-lg"
                                    placeholder="Email"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label"> Mobile Number: <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" class="form-control form-control-lg" placeholder="Mobile Number" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">
                                    Password: <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password"
                                    class="form-control form-control-lg"
                                    placeholder="Password"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">
                                    Confirm Password: <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="confirm_password"
                                    class="form-control form-control-lg"
                                    placeholder="Confirm Password"
                                    required>
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-3 mt-4">Address Details</h6>

                    <div class="mb-4">
                        <label class="form-label">
                            Address 1: <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="address_1"
                            class="form-control form-control-lg"
                            placeholder="Building name / Street / Area"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Address 2: <span class="text-danger"></span>
                        </label>
                        <input type="text" name="address_2"
                            class="form-control form-control-lg"
                            placeholder="Landmark, locality">
                    </div>
                    <br>
                    <!-- <div class="mb-4">
                        <label class="form-check">
                            <input type="checkbox"
                                class="form-check-input"
                                required>
                            <span class="form-check-label">
                                I agree to the <a href="">Terms & Conditions.</a>
                                <span class="text-danger"></span>
                            </span>
                        </label>
                    </div> -->

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        Create Account
                    </button>

                    <div class="text-center text-muted mt-4">
                        Already have an account?
                        <a href="<?php echo base_url('admin/login'); ?>">Log in</a>
                    </div>
                </form>
            </div>
            <div class="sa-divider sa-divider--has-text">
                <div class="sa-divider__text">Or continue with</div>
            </div>
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <div class="d-flex flex-wrap me-n3 mt-n3">
                    <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Google</button>
                    <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Facebook</button>
                    <button type="button" class="btn btn-secondary flex-grow-1 me-3 mt-3">Twitter</button>
                </div>
                <div class="form-group mb-0 mt-4 pt-2 text-center text-muted">
                    Already have an account?
                    <a href="<?php echo base_url('admin/login') ?>">
                        Log in
                    </a>
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