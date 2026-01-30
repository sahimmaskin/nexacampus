<!DOCTYPE html>
<html lang="en" dir="ltr" data-scompiler-id="0">

<head>
    <meta charSet="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <title><?= COMPANY_NAME ?> - <?= $title ?? '' ?></title>
    <meta name="csrf-name" content="<?= csrf_token() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">
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
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header">
                    <a class="sa-sidebar__logo" href="">
                        <div class="sa-sidebar-logo">
                            <img src="<?php echo base_url('assets/logo/logo.png'); ?>" alt="Logo" style="width:100%; ">
                        </div>
                    </a>
                </div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <div class="sa-nav__section-title">
                            </div>
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= base_url('admin/dashboard') ?>" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 16 16" fill="currentColor">
                                                <path
                                                    d="M8,13.1c-4.4,0-8,3.4-8-3C0,5.6,3.6,2,8,2s8,3.6,8,8.1C16,16.5,12.4,13.1,8,13.1zM8,4c-3.3,0-6,2.7-6,6c0,4,2.4,0.9,5,0.2C7,9.9,7.1,9.5,7.4,9.2l3-2.3c0.4-0.3,1-0.2,1.3,0.3c0.3,0.5,0.2,1.1-0.2,1.4l-2.2,1.7c2.5,0.9,4.8,3.6,4.8-0.2C14,6.7,11.3,4,8,4z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="sa-nav__title">
                                            Dashboard
                                        </span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= base_url('admin/view-designation') ?>" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class='fas fa-briefcase'></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Designation
                                        </span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="<?= base_url('admin/set-formats') ?>" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Set Formats
                                        </span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link" data-sa-collapse-trigger="">
                                        <span class="sa-nav__icon">
                                            <i class='fas fa-user-alt'></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Users
                                        </span>
                                        <span
                                            class="sa-nav__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path
                                                    d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/add-user') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Add
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/user-list') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    List
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link" data-sa-collapse-trigger="">
                                        <span class="sa-nav__icon">
                                            <i class='fas fa-book-open'></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Academics
                                        </span>
                                        <span
                                            class="sa-nav__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path
                                                    d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/view-session') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Session
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/view-class') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Class
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/view-section') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Section
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/view-subject') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Subject
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link" data-sa-collapse-trigger="">
                                        <span class="sa-nav__icon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Students
                                        </span>
                                        <span
                                            class="sa-nav__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path
                                                    d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/new-application') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    New Students
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/manage-students') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Manage Students
                                                </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/student-attendance') ?>"
                                                class="sa-nav__link">
                                                <span
                                                    class="sa-nav__menu-item-padding">
                                                </span>
                                                <span
                                                    class="sa-nav__title">
                                                    Mark Attendance
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon" data-sa-collapse-item="sa-nav__menu-item--open">
                                    <a href="#" class="sa-nav__link" data-sa-collapse-trigger="">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-rupee-sign"></i>
                                        </span>
                                        <span class="sa-nav__title">
                                            Fees
                                        </span>
                                        <span
                                            class="sa-nav__arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                height="9" viewBox="0 0 6 9" fill="currentColor">
                                                <path
                                                    d="M5.605,0.213 C6.007,0.613 6.107,1.212 5.706,1.612 L2.696,4.511 L5.706,7.409 C6.107,7.809 6.107,8.509 5.605,8.808 C5.204,9.108 4.702,9.108 4.301,8.709 L-0.013,4.511 L4.401,0.313 C4.702,-0.087 5.304,-0.087 5.605,0.213 Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="sa-nav__menu sa-nav__menu--sub" data-sa-collapse-content="">
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/fee-particulars') ?>"
                                                class="sa-nav__link">
                                                <span class="sa-nav__menu-item-padding"></span>
                                                <span class="sa-nav__title"> Fee Particular </span>
                                            </a>
                                        </li>
                                        <li class="sa-nav__menu-item">
                                            <a href="<?= base_url('admin/fee-setup') ?>"
                                                class="sa-nav__link">
                                                <span class="sa-nav__menu-item-padding"></span>
                                                <span class="sa-nav__title"> Fee Setup </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div><!-- sa-app__sidebar / end --><!-- sa-app__content -->
        <div class="sa-app__content"><!-- sa-app__toolbar -->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body">
                    <div class="sa-toolbar__item"><button class="sa-toolbar__button" type="button" aria-label="Menu"
                            data-sa-toggle-sidebar=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M1,11V9h18v2H1z M1,3h18v2H1V3z M15,17H1v-2h14V17z"></path>
                            </svg></button></div>
                    <div class="sa-toolbar__item sa-toolbar__item--search">
                        <!-- <form class="sa-search sa-search--state--pending"> -->
                            <!-- <div class="sa-search__body"><label class="visually-hidden" for="input-search">Search
                                    for:</label>
                                <div class="sa-search__icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                        height="1em" viewBox="0 0 16 16" fill="currentColor">
                                        <path
                                            d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z">
                                        </path>
                                    </svg></div><input type="text" id="input-search" class="sa-search__input"
                                    placeholder="Search for the truth" autoComplete="off" /><button
                                    class="sa-search__cancel d-sm-none" type="button" aria-label="Close search"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                        fill="currentColor">
                                        <path
                                            d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6 c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4 C11.2,9.8,11.2,10.4,10.8,10.8z">
                                        </path>
                                    </svg></button>
                                <div class="sa-search__field"></div>
                            </div>
                            <div class="sa-search__dropdown">
                                <div class="sa-search__dropdown-loader"></div>
                                <div class="sa-search__dropdown-wrapper">
                                    <div class="sa-search__suggestions sa-suggestions"></div>
                                    <div class="sa-search__help sa-search__help--type--no-results">
                                        <div class="sa-search__help-title">No results for &quot;<span
                                                class="sa-search__query"></span>&quot;</div>
                                        <div class="sa-search__help-subtitle">Make sure that all words are spelled
                                            correctly.</div>
                                    </div>
                                    <div class="sa-search__help sa-search__help--type--greeting">
                                        <div class="sa-search__help-title">Start typing to search for</div>
                                        <div class="sa-search__help-subtitle">Products, orders, customers, actions, etc.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sa-search__backdrop"></div> -->
                        <!-- </form> -->
                    </div>
                    <div class="mx-auto"></div>
                    <div class="sa-toolbar__item d-sm-none"><button class="sa-toolbar__button" type="button"
                            aria-label="Show search" data-sa-action="show-search"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"
                                fill="currentColor">
                                <path
                                    d="M16.243 14.828C16.243 14.828 16.047 15.308 15.701 15.654C15.34 16.015 14.828 16.242 14.828 16.242L10.321 11.736C9.247 12.522 7.933 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.933 12.522 9.247 11.736 10.321L16.243 14.828ZM6.5 2C4.015 2 2 4.015 2 6.5C2 8.985 4.015 11 6.5 11C8.985 11 11 8.985 11 6.5C11 4.015 8.985 2 6.5 2Z">
                                </path>
                            </svg></button></div>

                    <div class="dropdown sa-toolbar__item">
                        <button class="sa-toolbar-user" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-offset="0,1" aria-expanded="false">
                            <span class="sa-toolbar-user__info">
                                <span class="sa-toolbar-user__title">
                                    <?= session()->get('adminName') ?>
                                </span>
                                <span
                                    class="sa-toolbar-user__subtitle">
                                </span>
                            </span>
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/admin/my-profile') ?>">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/admin/logout') ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div>

            <?php
            $uri = service('uri');
            $url1 = $uri->getSegment(2, '');
            $url2 = $uri->getSegment(3, '');
            ?>

            <?= $this->renderSection('content') ?>
            <footer>
                <div class="sa-app__footer d-block d-md-flex">
                    <a href="<?= base_url() ?>"><?= COMPANY_NAME ?></a> © 2025<div class="m-auto"></div>
                    <div>
                        Designed & Developed by <a href="<?= base_url() ?>"> <?= COMPANY_NAME ?></a>
                    </div>
                </div>
            </footer>
        </div>
        <div class="sa-app__toasts toast-container bottom-0 end-0"></div>
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