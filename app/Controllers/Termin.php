<?php

namespace App\Controllers;
use App\Models\TerminModel;
use App\Models\E_katalogModel;
use CodeIgniter\Controller;
use App\Models\TenderModel;

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

      return view('termin/data kontrak', ['kontrak_ekatalog' => $kontrakEkatalog, 'kontrak_tender' => $kontrakTender] );
    }

    public function save()
    {
      $terminModel = new TerminModel();

      $data = [
          'kontrak_id' => $this->request->getPost('kontrak_id'),
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

    // Ambil semua termin
    $termins = $terminModel->findAll();

    // Ambil semua kontrak dari e-katalog dan tender
    $ekatalog = $ekatalogModel->findAll();
    $tender = $tenderModel->findAll();

    // Gabungkan semua kontrak ke dalam satu array dengan id & nama
    $kontrak = [];

    foreach ($ekatalog as $k) {
        $kontrak[$k['id']] = '[E-Katalog] ' . ($k['nomor_kontrak'] ?? '-') . ' - ' . $k['nama'];
    }

    foreach ($tender as $t) {
        $kontrak[$t['id']] = '[Tender] ' . ($t['nomor_kontrak'] ?? '-') . ' - ' . $t['nama'];
    }

    return view('termin/daftar termin', [
        'termins' => $termins,
        'kontrakList' => $kontrak
    ]);
    }

    public function delete($id)
    {
        $model = new TerminModel();
        $model->delete($id);
        return redirect()->to('input_termin');
    }
}
