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

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek apakah user ada di database
        $user = $userModel->getUserByUsername($username);

        if ($user) {
            // Verifikasi password (pastikan password di-hash saat disimpan)
            if ($password === $user['password']) {
                // Set session jika login berhasil
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

