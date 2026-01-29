<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SchoolSettingController extends BaseController
{
    public function schoolSettings()
    {
        return view('admin/school/school_settings');
    }
}
