<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('get-district/(:any)', 'FetchController::getDistrict/$1');
$routes->get('get-section/(:any)', 'FetchController::getSection/$1');
$routes->get('check-user-mobile/(:any)', 'FetchController::checkUserMobile/$1');
$routes->get('get-student/(:any)/(:any)/(:any)', 'FetchController::getStudent/$1/$2/$3');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'LoginController::index');
    $routes->get('login', 'LoginController::index');
    $routes->get('sign-up', 'RegisterController::sign_up_form');
    $routes->post('sign-up', 'RegisterController::sign_up');
    $routes->post('login', 'LoginController::auth');
    $routes->get('reset-password', 'LoginController::reset_pwd_form');
    $routes->post('reset-password', 'LoginController::reset_pwd');
    $routes->get('logout', 'LoginController::logout');

    $routes->group('', ['filter' => 'authadmin'], function ($routes) {

        $routes->get('my-profile', 'ProfileController::myProfile');

        $routes->get('dashboard', 'DashboardController::index');

        $routes->get('view-designation', 'DeignationController::viewDesignation');

        $routes->get('set-formats', 'FormatController::formatList');
        $routes->post('format-update', 'FormatController::saveFormat');

        $routes->get('user-list', 'UserController::index');
        $routes->get('add-user', 'UserController::form');
        $routes->get('edit-user/(:any)', 'UserController::form/$1');
        $routes->post('save-user', 'UserController::save');

        $routes->get('profile', 'DashboardController::index');
        $routes->get('change-password', 'DashboardController::index');

        $routes->get('view-session', 'AcademicController::index');
        $routes->post('save-session', 'AcademicController::saveSession');
        $routes->get('view-class', 'AcademicController::classList');
        $routes->post('save-class', 'AcademicController::saveClass');
        $routes->get('view-section', 'AcademicController::sectionList');
        $routes->post('save-section', 'AcademicController::saveSection');
        $routes->get('view-subject', 'AcademicController::subjectList');
        $routes->post('save-subject', 'AcademicController::saveSubject');

        $routes->get('new-application', 'StudentController::form');
        $routes->post('save-student', 'StudentController::save');
        $routes->get('update-documents/(:any)', 'StudentController::updateDocuments/$1');
        $routes->post('save-documents', 'StudentController::saveDocuments');
        $routes->get('manage-students', 'StudentController::studentList');
        $routes->get('student-attendance', 'StudentController::markAttendance');
        $routes->post('save-attendance', 'StudentController::saveAttendance');

        $routes->get('fee-particulars', 'FeeController::particularsList');
        $routes->post('save-particulars', 'FeeController::saveParticulars');

        $routes->get('fee-setup', 'FeeController::feeSetUp');
        $routes->post('save-fee', 'FeeController::saveFee');
    });
});
