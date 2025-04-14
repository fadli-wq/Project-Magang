<?php

namespace App\Models;
use CodeIgniter\Model;

class TerminModel extends Model
{
    protected $table = 'termin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kontrak_id', 'tgl_termin', 'termin_ke', 'nilai_termin'];
}
