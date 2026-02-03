<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\DesignationModel;
use App\Models\DepartmentModel;

class DesignationController extends BaseController
{
    protected $schoolId;
    protected $designationModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->designationModel = new DesignationModel();
        $this->departmentModel = new DepartmentModel();
        $this->schoolId = session()->get('schoolId');
    }

    public function viewDesignation()
    {
        $limit = PER_PAGE;
        $allDesignation = $this->designationModel
            ->select('designation.*, department.name as department_name')
            ->join('department', 'department.id = designation.department_id', 'left')
            ->groupStart()
            ->where('designation.school_id', $this->schoolId)
            ->orWhere('designation.school_id', null)
            ->groupEnd()
            ->asArray()
            ->paginate($limit);
        $data = [
            'title'         => 'Designation',
            'lists'         => $allDesignation,
            'departmentList'    => $this->departmentModel->where('status', 'Active')->findAll(),
            'pager'         => $this->designationModel->pager,
            'limit'         => $limit,
        ];
        return view('admin/designation-list', $data);
    }

    public function saveDesignation()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'department_id'            => !empty($this->request->getPost('department_id')) ? $this->request->getPost('department_id') : null,
            'name'            => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,
            'school_id'            => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
        ];

        if ($id) {
            $this->designationModel->update($id, $formData);
            $lastID = $id;
        } else {
            $lastID = $this->designationModel->insert($formData);
        }

        return redirect('admin/view-designation')->with(
            'success',
            $id ? 'Designation updated successfully' : 'Designation added successfully'
        );
    }
}
