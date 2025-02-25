<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class Home extends Controller
{
    public function index()
    {
      return view("termin/input termin");
    }
}

