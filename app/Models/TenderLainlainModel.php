<?php

namespace App\Models;

use CodeIgniter\Model;

class TenderLainlainModel extends Model
{
    protected $table = '`tender_lain-lain`';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_kontrak','kode_paket', 'kode_item', 'nama_item', 'kuantitas', 'harga_satuan', 'penyedia'];
}
