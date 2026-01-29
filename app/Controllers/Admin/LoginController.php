<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TrustModel;
use App\Models\SchoolModel;

class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('isAdmin')) {
            return redirect()->to('/admin/dashboard');
        } else {
            return view('admin/login', ['title' => 'Admin Login']);
        }
    }

    public function auth()
    {
        $validation = \Config\Services::validation();

        $rules = [
            //'email'    => 'required|valid_email',
            'login_id'    => 'required',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $login_id = $this->request->getPost('login_id');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $trustModel = new TrustModel();
        $schoolModel = new SchoolModel();

        $trustData = $trustModel->where('mobile', $login_id)
            ->orWhere('username', $login_id)
            ->orWhere('email', $login_id)
            ->first();

        if ($trustData) {

            if ($trustData['status'] != 'Active') {
                return redirect()->back()->with('error', 'Id not active.');
            }

            if (password_verify($password, $trustData['password'])) {

                $trustId = $trustData['id'];

                $schoolData = $schoolModel->where('trust_id', $trustId)
                    ->first();

                $schoolId = $schoolData['id'];

                /*if ($trustData['is_logged'] == 'Yes') {
                    return redirect()->back()->with('error', 'Already logged in.');
                }*/

                $insData = [
                    'user_id'       => $trustId,
                    'login_time'    => date('Y-m-d H:i:s'),
                ];

                // $userLoginModel = new UserLoginModel();

                // $userLoginModel->insert($insData);

                // $usersModel->update($userId, ['is_logged' => 'Yes']);

                session()->set([
                    'isAdmin'   => true,
                    'trustId'   => $trustId,
                    'schoolId'   => $schoolId,
                    'adminName' => $trustData['school_name'],
                ]);

                // if ($remember) {
                //     $token = bin2hex(random_bytes(16));
                //     $expiry = time() + (60 * 60 * 24 * 30);

                //     $updData = [
                //         'remember_token' => $token,
                //         'token_expire'   => date('Y-m-d H:i:s', $expiry),
                //     ];

                //     $usersModel->update($userId, $updData);

                //     setcookie('remember_token', $token, $expiry, '/', '', false, true);
                // }

                return redirect()->to('/admin/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Invalid login id or password');
    }

    public function reset_pwd_form($value = '')
    {
        return redirect()->to('/admin/login');
    }

    public function logout()
    {
        $userId = session()->get('adminId');

        // $userLoginModel = new UserLoginModel();

        // $lastLogged = $userLoginModel->where('user_id', $userId)
        //     ->where('logout_time', NULL)
        //     ->orderBy('id', 'DESC')->first();

        // if (!empty($lastLogged)) {
        //     $lastId = $lastLogged['id'];

        //     $userLoginModel->update($lastId, ['logout_time' => date('Y-m-d H:i:s')]);
        // }

        // $usersModel = new UsersModel();

        // $usersModel->update($userId, ['is_logged' => 'No']);

        session()->destroy();
        // setcookie('remember_token', '', time() - 3600, '/');

        return redirect()->to('/admin/login');
    }
}
