<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TrustModel;
use App\Models\SchoolModel;
use App\Models\PlanModel;
use App\Models\UserModel;
use App\Models\DepartmentModel;

class DashboardController extends BaseController
{
    protected $trustModel;
    protected $schoolModel;
    protected $userId;
    protected $user;

    public function __construct()
    {
        $session = session();
        if (!$session->has('userId') || $session->get('isAdmin') !== true) {
            redirect()->to('/admin/login')->send();
            exit;
        }
        $this->userId = $session->get('userId');
        $this->trustModel  = new TrustModel();
        $this->schoolModel = new SchoolModel();
        $userModel = new UserModel();
        $this->user = $userModel->find($this->userId);
        if (!$this->user) {
            $session->destroy();
            redirect()->to('/admin/login')->send();
            exit;
        }
        if ($this->user['accn_status'] === 'Pending') {
            $uri = service('uri')->getPath();
            if ($uri !== 'admin/activate') {
                redirect()->to('/admin/activate')->send();
                exit;
            }
        }
    }

    public function index()
    {
        $departmentModel = new DepartmentModel();
        $planModel       = new PlanModel();

        $plans = $planModel
            ->where('status', 'Active')
            ->findAll();

        $allDepartments = $departmentModel
            ->where('status', 'Active')
            ->findAll();

        return view('admin/dashboard', [
            'title'          => 'Dashboard',
            'plans'          => $plans,
            'allDepartments' => $allDepartments,
            'user'           => $this->user,
        ]);
    }
}
