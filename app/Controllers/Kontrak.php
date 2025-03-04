<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kontrak extends BaseController
{
    public function index()
    {
      return view('kontrak/index');
    }
    public function e_katalog()
    {
      return view('kontrak/input e-katalog');
    }
    public function pl()
    {
      return view('kontrak/input pl');
    }
    public function tender()
    {
      return view('kontrak/input tender');
    }
}
