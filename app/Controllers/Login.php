<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\LoginModel;

class Login extends Controller
{
    public function index()
    {
      return view('login/login');
    }
    public function authenticate()
    {
        $session = session();
        $userModel = new LoginModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByUsername($username);

        if ($user) {
            if ($password === $user['password']) {
                $session->set([
                    'isLoggedIn' => true,
                    'username' => $user['username'],
                ]);

                return redirect()->to(base_url('dashboard'))->with('success', 'Login Berhasil!');
            } else {
                return redirect()->to(base_url('login'))->with('error', 'Password salah!');
            }
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Username tidak ditemukan!');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Berhasil Logout!');
    }
}
