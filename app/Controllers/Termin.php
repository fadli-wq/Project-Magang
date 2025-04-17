<?php

namespace App\Controllers;
use App\Models\TerminModel;
use App\Models\E_katalogModel;
use CodeIgniter\Controller;
use App\Models\TenderModel;
use App\Models\PlModel;

class Termin extends Controller
{
    public function index()
    {
      return view('termin/index');
    }
    public function input()
    {
        $model = new TerminModel();
        $data['termins'] = $model->findAll();
        return view('termin/input termin', $data);
    }

    public function data()
    {
      $kontrakModelEkatalog = new E_katalogModel();
      $kontrakEkatalog = $kontrakModelEkatalog->findAll();

      $kontrakModelTender = new TenderModel();
      $kontrakTender = $kontrakModelTender->findAll(); 

      $kontrakModelPl = new PlModel();
      $kontrakPl = $kontrakModelPl->findAll(); 

      $pembayaranEModel = new \App\Models\E_katalogPembayaranModel();
      $pembayaranTModel = new \App\Models\TenderPembayaranModel();
      $pembayaranPModel = new \App\Models\PlPembayaranModel();
      // Tambahkan jumlah_termin ke masing-masing kontrak
      foreach ($kontrakEkatalog as &$k) {
          $pembayaran = $pembayaranEModel->where('id_kontrak', $k['id'])->first();
          $k['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
      }

      foreach ($kontrakTender as &$t) {
          $pembayaran = $pembayaranTModel->where('id_kontrak', $t['id'])->first();
          $t['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
      }
      foreach ($kontrakPl as &$p) {
          $pembayaran = $pembayaranPModel->where('id_kontrak', $p['id'])->first();
          $p['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
      }

      return view('termin/data kontrak', ['kontrak_ekatalog' => $kontrakEkatalog, 'kontrak_tender' => $kontrakTender, 'kontrak_pl' => $kontrakPl] );
    }

    public function save()
    {
      $terminModel = new TerminModel();

      $data = [
          'kontrak_id' => $this->request->getPost('kontrak_id'),
          'nomor_kontrak' => $this->request->getPost('nomor_kontrak'),
          'tgl_termin' => $this->request->getPost('tgl_termin'),
          'termin_ke' => $this->request->getPost('termin_ke'),
          'nilai_termin' => $this->request->getPost('nilai_termin'),
      ];

      if ($terminModel->insert($data)) {
          return redirect()->to(base_url('termin'))->with('success', 'Termin berhasil disimpan.');
      } else {
          return redirect()->back()->withInput()->with('error', 'Gagal menyimpan termin.');
      }
    }

    public function daftar()
    {
    $terminModel = new \App\Models\TerminModel();
    $ekatalogModel = new \App\Models\E_katalogModel();
    $tenderModel = new \App\Models\TenderModel();
    $plModel = new \App\Models\PlModel();
    $pembayaranEModel = new \App\Models\E_katalogPembayaranModel();
    $pembayaranTModel = new \App\Models\TenderPembayaranModel();
    $pembayaranPModel = new \App\Models\PlPembayaranModel();

    // Ambil semua termin
    $termins = $terminModel->findAll();

    // Ambil semua kontrak dari e-katalog dan tender
    $ekatalog = $ekatalogModel->findAll();
    $tender = $tenderModel->findAll();
    $pl = $plModel->findAll();

    $pembayaranE = $pembayaranEModel->findAll();
    $pembayaranT = $pembayaranTModel->findAll();

    // Gabungkan semua kontrak ke dalam satu array dengan id & nama
    $kontrak = [];
    $kontrakList = [];
    $jumlahTerminPerKontrak = [];
    // foreach ($ekatalog as $k) {
    //     $kontrak[$k['id']] = '[E-Katalog] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];
    // }

    // foreach ($tender as $t) {
    //     $kontrak[$t['id']] = '[Tender] ' . ($t['nomor_kontrak'] ?? '-') . ' - ' . $t['nama'];
    // }
    // foreach ($pl as $p) {
    //   $kontrak[$p['id']] = '[Tender] ' . ($p['nomor_kontrak'] ?? '-') . ' - ' . $p['nama'];
    // }

    foreach ($ekatalog as $k) {
      $kontrakList['e' . $k['id']] = '[E-Katalog] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];
    }
    
    // Kontrak Tender
    foreach ($tender as $k) {
        $kontrakList['t' . $k['id']] = '[Tender] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];
    }
    
    // Kontrak PL
    foreach ($pl as $k) {
        $kontrakList['p' . $k['id']] = '[PL] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];
    }

    foreach ($ekatalog as &$k) {
      $pembayaran = $pembayaranEModel->where('id_kontrak',$k['id'])->first();
      $k['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
    }

    foreach ($tender as &$t) {
        $pembayaran = $pembayaranTModel->where('id_kontrak',$t['id'])->first();
        $t['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
    }
    foreach ($pl as &$p) {
        $pembayaran = $pembayaranPModel->where('id_kontrak',$p['id'])->first();
        $p['jumlah_termin'] = $pembayaran['jumlah_termin'] ?? '-';
    }

    // Hitung jumlah termin untuk setiap kontrak
    foreach ($termins as $t) {
        $id = $t['kontrak_id']; // Sudah dalam bentuk 'e5', 't1', dst
        if (!isset($jumlahTerminPerKontrak[$id])) {
            $jumlahTerminPerKontrak[$id] = 0;
        }
        $jumlahTerminPerKontrak[$id]++;
    }


  //   foreach ($termins as &$termin) {
  //     $id = $termin['kontrak_id'];
  
  //     if (isset($kontrakList['e' . $id])) {
  //         $termin['kontrak_id_prefixed'] = 'e' . $id;
  //     } elseif (isset($kontrakList['t' . $id])) {
  //         $termin['kontrak_id_prefixed'] = 't' . $id;
  //     } elseif (isset($kontrakList['p' . $id])) {
  //         $termin['kontrak_id_prefixed'] = 'p' . $id;
  //     } else {
  //         $termin['kontrak_id_prefixed'] = null;
  //     }
  // }
  
    return view('termin/daftar termin', [
        'termins' => $termins,
        'kontrakList' => $kontrakList,
        'ekatalog' => $ekatalog,
        'pl' => $pl,
        'tender' => $tender,
        'jumlahTerminPerKontrak' => $jumlahTerminPerKontrak
    ]);
    }

    public function delete($id)
    {
        $model = new TerminModel();
        $model->delete($id);
        return redirect()->to('input_termin');
    }
}
