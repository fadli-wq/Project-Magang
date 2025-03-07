<?php

namespace App\Models;

use CodeIgniter\Model;

class E_katalogPembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['pagu', 'metode', 'jumlah_termin', 'sumber dana'];
}
