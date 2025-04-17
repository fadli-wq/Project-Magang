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

    $termins = $terminModel->findAll();
    $ekatalog = $ekatalogModel->findAll();
    $tender = $tenderModel->findAll();
    $pl = $plModel->findAll();

    $kontrakList = [];
    $jumlahTerminPerKontrak = [];

    // Gabungkan semua kontrak ke dalam array
    foreach ($ekatalog as $k) {
        $id = 'e' . $k['id'];
        $kontrakList[$id] = '[E-Katalog] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];

        $pembayaran = $pembayaranEModel->where('id_kontrak', $k['id'])->first();
        $jumlahTerminPerKontrak[$id] = $pembayaran['jumlah_termin'] ?? '-';
    }

    foreach ($tender as $k) {
        $id = 't' . $k['id'];
        $kontrakList[$id] = '[Tender] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];

        $pembayaran = $pembayaranTModel->where('id_kontrak', $k['id'])->first();
        $jumlahTerminPerKontrak[$id] = $pembayaran['jumlah_termin'] ?? '-';
    }

    foreach ($pl as $k) {
        $id = 'p' . $k['id'];
        $kontrakList[$id] = '[PL] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];

        $pembayaran = $pembayaranPModel->where('id_kontrak', $k['id'])->first();
        $jumlahTerminPerKontrak[$id] = $pembayaran['jumlah_termin'] ?? '-';
    }

    return view('termin/daftar termin', [
        'termins' => $termins,
        'kontrakList' => $kontrakList,
        'jumlahTerminPerKontrak' => $jumlahTerminPerKontrak,
    ]);
    }

    public function delete($id)
    {
        $model = new TerminModel();
        $model->delete($id);
        return redirect()->to('input_termin');
    }
    public function done($id)
    {
    $terminModel = new TerminModel();
    $terminModel->update($id, ['status' => 'selesai']);
    return redirect()->to(base_url('input_termin'))->with('success', 'Termin telah diselesaikan.');
    }

}
