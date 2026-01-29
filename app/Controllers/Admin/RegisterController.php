<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TrustModel;
use App\Models\SchoolModel;
use App\Models\UserModel;

class RegisterController extends BaseController
{
    protected $trustModel;
    protected $schoolModel;
    protected $userModel;
    public function __construct()
    {
        $this->trustModel = new TrustModel();
        $this->schoolModel = new SchoolModel();
        $this->userModel = new UserModel();
        helper(['form', 'url', 'custom']);
    }

    public function sign_up_form()
    {
        return view('admin/sign-up', ['title' => 'Sign Up']);
    }

    public function sign_up()
    {
        $password = !empty($this->request->getPost('password')) ? $this->request->getPost('password') : null;
        $confirm_password    = !empty($this->request->getPost('confirm_password')) ? $this->request->getPost('confirm_password') : null;

        if ($password != $confirm_password) {
            return redirect()->back()
                ->with('error', 'Passwords do not match')
                ->withInput();
        }

        $formData = [
            'trust_name'  => !empty($this->request->getPost('trust_name')) ? $this->request->getPost('trust_name') : null,
            'mobile'    => !empty($this->request->getPost('mobile')) ? $this->request->getPost('mobile') : null,
            'password'    => password_hash($password, PASSWORD_DEFAULT),
            'address_1'    => !empty($this->request->getPost('address_1')) ? $this->request->getPost('address_1') : null,
            'address_2'    => !empty($this->request->getPost('address_2')) ? $this->request->getPost('address_2') : null
        ];
        $formData['accn_status'] = !empty($this->request->getPost('accn_status')) ? $this->request->getPost('accn_status') : 'Pending';
        $formData['status'] = !empty($this->request->getPost('status')) ? $this->request->getPost('status') : 'Active';
        try {
            $lastID = $this->trustModel->insert($formData);
            if ($lastID === false) {
                return redirect()->back()
                    ->with('errors', $this->trustModel->errors())
                    ->withInput();
            }
            $schoolFormData = [
                'trust_id'  => $lastID,
                'school_name'  => !empty($this->request->getPost('school_name')) ? $this->request->getPost('school_name') : null,
                'email'       => !empty($this->request->getPost('email')) ? $this->request->getPost('email') : null,
                'mobile'    => !empty($this->request->getPost('mobile')) ? $this->request->getPost('mobile') : null,
                'password'    => password_hash($password, PASSWORD_DEFAULT),
                'address_1'    => !empty($this->request->getPost('address_1')) ? $this->request->getPost('address_1') : null,
                'address_2'    => !empty($this->request->getPost('address_2')) ? $this->request->getPost('address_2') : null,
                'status' => !empty($this->request->getPost('status')) ? $this->request->getPost('status') : 'Active'
            ];
            $schoolId = $this->schoolModel->insert($schoolFormData);
            $userData = [
                'school_id'  => $schoolId,
                'name'  => !empty($this->request->getPost('school_name')) ? $this->request->getPost('school_name') : null,
                'email'       => !empty($this->request->getPost('email')) ? $this->request->getPost('email') : null,
                'mobile'    => !empty($this->request->getPost('mobile')) ? $this->request->getPost('mobile') : null,
                'password'    => password_hash($password, PASSWORD_DEFAULT),
                'user_type' => 'Trust',
                'status' => !empty($this->request->getPost('status')) ? $this->request->getPost('status') : 'Active'
            ];
            $this->userModel->insert($userData);
            return redirect()->to('/admin/login')->with('success', 'Added Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Database insert failed: ' . $e->getMessage())
                ->withInput();
        }
    }
}
