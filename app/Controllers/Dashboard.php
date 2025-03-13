<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LainlainModel;

class Dashboard extends BaseController
{
    public function index()
    {
      $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu!');
        }

        $lainlainModel = new LainlainModel();

        $vendors = $lainlainModel->select('penyedia')->distinct()->findAll();

        $data = [
            'vendors' => $vendors
        ];
        return view('dashboard/dashboard', $data);
    }
}
