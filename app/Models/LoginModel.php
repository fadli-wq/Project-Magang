<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password'];
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
