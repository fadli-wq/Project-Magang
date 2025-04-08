<?php

namespace App\Models;

use CodeIgniter\Model;

class TenderPembayaranModel extends Model
{
    protected $table            = 'tender_pembayaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_kontrak','pagu', 'metode', 'jumlah_termin', 'sumber_dana'];
}
