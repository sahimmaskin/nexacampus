<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Controllers\Admin\AdminBaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\DepartmentModel;

class DashboardController extends AdminBaseController
{
    protected $userId;

    public function __construct()
    {
        $this->userId  = session()->get('adminId');
    }


    public function index()
    {
        $departmentModel = new DepartmentModel();

        $allDepartments = $departmentModel
            ->where('status', 'Active')
            ->findAll();

        $data = [
            'title'          => 'Dashboard',
            'allDepartments' => $allDepartments,
        ];

        return view('admin/dashboard', $data);
    }
}
