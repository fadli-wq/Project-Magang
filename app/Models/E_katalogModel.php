<?php

namespace App\Models;
use CodeIgniter\Model;

class E_katalogModel extends Model
{
    protected $table = 'e-katalog';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nomor_sp', 'nomor_spmk', 'nomor_spp', 'tgl_sp', 'tgl_spmk', 'tgl_spp', 'tgl_delivery', 'lama_pekerjaan', 'nilai_kontrak', 'terbilang','nomor_kontrak', 'tgl_kontrak'];
}
