<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\DepartmentModel;
use App\Models\DistrictModel;
use App\Models\StudentModel;
use App\Models\SectionModel;
use App\Models\UserModel;

class FetchController extends BaseController
{
    protected $studentModel;
    protected $sectionModel;
    public function __construct()
    {
        helper(['form', 'url', 'custom']);
    }
    public function getDepartments()
    {
        $departmentsModel = new DepartmentModel();

        $deptId = $this->request->getPost('dept_id') ?? null;

        $departmentsModel->where('status', 'Active');

        if (!empty($deptId)) {
            $departmentsModel->where('id', $deptId);
        }

        $departments = $departmentsModel->findAll();

        return $this->response
            ->setHeader('X-CSRF-TOKEN', csrf_hash())
            ->setJSON($departments);
    }

    public function getDistrict($state_id)
    {
        $districtModel = new DistrictModel();

        $districts = $districtModel
            ->where('state_id', $state_id)
            ->findAll();

        return $this->response->setJSON($districts);
    }

    public function getSection($class_id)
    {
        $sectionModel = new SectionModel();

        $sections = $sectionModel
            ->where('class_id', $class_id)
            ->findAll();

        return $this->response->setJSON($sections);
    }

    public function getStudent($class_id = '', $session_id = '', $section_id = '')
    {
        $this->studentModel = new StudentModel();

        if (empty($class_id) || empty($session_id)) {
            return $this->response->setJSON([]);
        }

        $students = $this->studentModel
            ->where('class', $class_id)
            ->where('session', $session_id)
            ->where('section', $section_id)
            ->findAll();

        return $this->response->setJSON($students);
    }

    public function checkUserMobile($mobile)
    {
        $userModel = new UserModel();
        $q1 = $userModel->where('mobile', $mobile)->findAll();
        if (count($q1) > 0) {
            $arr = [
                'error' => 'Yes',
                't' => 'warning',
                'mess' => 'This Mobile Number is already registered.',
            ];
        } else {
            $arr = [
                'error' => 'No',
            ];
        }
        return $this->response->setJSON($arr);
    }
}
