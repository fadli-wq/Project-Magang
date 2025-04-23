<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LainlainModel;
use App\Models\DirekturModel;
use App\Models\E_katalogModel;
use App\Models\E_katalogPembayaranModel;
use App\Models\TenderModel;
use App\Models\TenderPembayaranModel;
use App\Models\PlModel;
use App\Models\TerminModel;

class Dashboard extends BaseController
{
    public function index()
    {
      $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu!');
        }

        $lainlainModel = new LainlainModel();
        $eKatalogModel = new E_katalogModel();
        $tenderModel = new TenderModel();
        $plModel = new PlModel();
        $terminModel = new TerminModel();
        $e_katalog = $eKatalogModel->findAll();
        $tender    = $tenderModel->findAll();
        $pl        = $plModel->findAll();
        $termin    = $terminModel->findAll();

        // Gabungkan semua kontrak
        $kontrakGabungan = array_merge($e_katalog, $tender, $pl);
        $kontrakBerjalan = [];
        $kontrakSelesai  = [];

        foreach ($kontrakGabungan as $kontrak) {
          $nilaiKontrak = $kontrak['nilai_kontrak'];
          $termins = $terminModel->where('kontrak_id', $kontrak['id'])->findAll();
          $totalTermin = array_sum(array_column($termins, 'jumlah'));
  
          if ($totalTermin >= $nilaiKontrak) {
              $kontrakSelesai[] = $kontrak;
          } else {
              $kontrakBerjalan[] = $kontrak;
          }
        }
        $totalEkatalog = array_sum(array_column($e_katalog, 'nilai_kontrak'));
        $totalTender   = array_sum(array_column($tender, 'nilai_kontrak'));
        $totalPl       = array_sum(array_column($pl, 'nilai_kontrak'));

        $vendors = $lainlainModel->select('penyedia')->distinct()->findAll();
        $data = [
            'e_katalog' => $eKatalogModel->findAll(),
            'tender' => $tenderModel->findAll(),
            'pl' => $plModel->findAll(),
            'termin' => $terminModel->findAll(),
            'vendors' => $vendors,
            'kontrak_berjalan' => $kontrakBerjalan,
            'kontrak_selesai'  => $kontrakSelesai,
            'nilai_kontrak' => [
            'e_katalog' => $totalEkatalog,
            'tender'    => $totalTender,
            'pl'        => $totalPl,
            ]
        ];
        return view('dashboard/dashboard', $data);
    }
}
