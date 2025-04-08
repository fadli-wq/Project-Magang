<?php

namespace App\Models;
use CodeIgniter\Model;

class DirekturModel extends Model
{
    protected $table = 'direktur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_direktur', 'jabatan_direktur'];
}
