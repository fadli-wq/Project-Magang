<?php

namespace App\Models;
use CodeIgniter\Model;

class PlModel extends Model
{
    protected $table = 'pl';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nomor_spk', 'nomor_spmk', 'tgl_spk', 'tgl_spmk', 'tgl_delivery', 'lama_pekerjaan', 'nilai_kontrak', 'terbilang','nomor_kontrak', 'tgl_kontrak'];
}
