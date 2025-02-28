<?php

namespace App\Models;
use CodeIgniter\Model;

class TerminModel extends Model
{
    protected $table = 'termin_pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kontrak_id', 'jumlah', 'tgl_pembayaran', 'termin_ke'];
}
