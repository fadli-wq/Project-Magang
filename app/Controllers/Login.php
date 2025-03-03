<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class Login extends Controller
{
    public function index()
    {
      return view('login/login');
    }
}

