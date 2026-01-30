<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'custom']);
    }

    public function index()
    {
        if (session()->has('userId') && session()->get('isAdmin') === true) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/login', ['title' => 'Admin Login']);
    }

    public function auth()
    {
        $rules = [
            'login_id' => 'required',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $login_id = trim($this->request->getPost('login_id'));
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        $user = $userModel
            ->groupStart()
            ->where('mobile', $login_id)
            ->orWhere('email', $login_id)
            ->groupEnd()
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid login id or password');
        }

        if ($user['status'] !== 'Active') {
            return redirect()->back()->with('error', 'Id not active');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid login id or password');
        }
        session()->regenerate(true);

        session()->set([
            'isAdmin'  => true,
            'userId'   => $user['id'],
            'schoolId' => $user['school_id'],
            'trustId'  => $user['trust_id'],
            'userType' => $user['user_type'],
        ]);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
