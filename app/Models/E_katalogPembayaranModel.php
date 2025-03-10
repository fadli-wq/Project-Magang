<?php

namespace App\Models;

use CodeIgniter\Model;

class E_katalogPembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_kontrak','pagu', 'metode', 'jumlah_termin', 'sumber_dana'];
}
