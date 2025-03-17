<?php

namespace App\Models;
use CodeIgniter\Model;

class TenderModel extends Model
{
    protected $table = 'tender';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nomor_perjanjian', 'nomor_spmk', 'tgl_spmk', 'tgl_delivery', 'lama_pekerjaan', 'nilai_kontrak', 'terbilang','nomor_kontrak', 'tgl_kontrak'];
}
