<?php

namespace App\Models;

use CodeIgniter\Model;

class PlPembayaranModel extends Model
{
    protected $table            = 'pl_pembayaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_kontrak','pagu', 'metode', 'jumlah_termin', 'sumber_dana'];
}
