<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerSubmit()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'username' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ])) {
            return "❌ Validation failed: <pre>" . print_r($validation->getErrors(), true) . "</pre>";
        }

        $model = new \App\Models\UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user' // Default role
        ];

        $saved = $model->save($data);

        if (!$saved) {
            return "❌ Save failed: <pre>" . print_r($model->errors(), true) . "</pre>";
        }

        return redirect()->to('/login')->with('success', 'Account created. Please login.');
    }

    public function login()
    {
        return view('login');
    }

    public function loginSubmit()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            session()->set('role', $user['role']);
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/shop');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
