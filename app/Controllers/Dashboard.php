<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
      $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu!');
        }

        return view('dashboard/dashboard');
    }
}
