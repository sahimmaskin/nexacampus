<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\DepartmentModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $trustId;
    protected $schoolId;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->trustId  = session()->get('trustId');
        $this->schoolId = session()->get('schoolId');
        helper(['form', 'url', 'custom']);
    }

    public function index()
    {
        $limit = PER_PAGE;

        $details = $this->userModel
            ->select('user.*, d.name as deptName')
            ->join('department as d', 'd.id=user.user_type', 'left')
            ->where('trust_id', $this->trustId)
            ->where('school_id', $this->schoolId)
            ->paginate($limit);

        $data = [
            'title'         => 'Users',
            'lists'         => $details,
            'pager'         => $this->userModel->pager,
            'limit'         => $limit,
        ];

        return view('admin/user-list', $data);
    }

    public function form($encodedId = '')
    {
        $departmentModel = new DepartmentModel();
        $id = (!empty($encodedId)) ? base64url_decode($encodedId) : null;

        $details = $id
            ? $this->userModel
            ->select('user.*')
            ->where('user.id', $id)
            ->first()
            : null;

        $data = [
            'title'         => $id ? 'Edit User' : 'Add User',
            'encodedId'     => $encodedId,
            'details'       => $details,
            'departmentList'    => $departmentModel->where('status', 'Active')->findAll(),
        ];

        return view('admin/user-form', $data);
    }

    public function save()
    {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : null;

        $formData = [
            'trust_id'            => !empty($this->request->getPost('trust_id')) ? $this->request->getPost('trust_id') : null,
            'school_id'            => !empty($this->request->getPost('school_id')) ? $this->request->getPost('school_id') : null,
            'name'            => !empty($this->request->getPost('name')) ? $this->request->getPost('name') : null,
            'user_type'       => !empty($this->request->getPost('user_type')) ? $this->request->getPost('user_type') : null,
            'mobile'    => !empty($this->request->getPost('mobile')) ? $this->request->getPost('mobile') : null,
            'email'    => !empty($this->request->getPost('email')) ? $this->request->getPost('email') : null,
            'address'    => !empty($this->request->getPost('address')) ? $this->request->getPost('address') : null
        ];

        if ($id) {
            $formData['status'] = !empty($this->request->getPost('status')) ? $this->request->getPost('status') : 'Inactive';
        } else {
            $formData['status'] = !empty($this->request->getPost('status')) ? $this->request->getPost('status') : 'Active';
        }

        $details = (!empty($id)) ? $this->userModel->find($id) : null;

        if ($id) {
            try {
                if ($this->userModel->update($id, $formData) === false) {
                    return redirect()->back()
                        ->with('errors', $this->userModel->errors())
                        ->withInput();
                }

                return redirect()->to('/admin/user-list')->with('success', 'Updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Database updation failed: ' . $e->getMessage())
                    ->withInput();
            }
        } else {
            try {
                $password = rand(100000, 999999);
                $formData['password'] = password_hash($password, PASSWORD_DEFAULT);
                $lastID = $this->userModel->insert($formData);
                if ($lastID === false) {
                    return redirect()->back()
                        ->with('errors', $this->userModel->errors())
                        ->withInput();
                }
                return redirect()->to('/admin/add-user')
                    ->with('success', 'Added successfully! Login password is ' . $password);
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Database insert failed: ' . $e->getMessage())
                    ->withInput();
            }
        }
    }
}
