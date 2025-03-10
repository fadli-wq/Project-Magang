<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\E_katalogModel;
use App\Models\LainlainModel;
use App\Models\E_katalogPembayaranModel;

class Kontrak extends BaseController
{
    public function index()
    {
      return view('kontrak/index');
    }
    public function e_katalog()
    {
      return view('kontrak/e-katalog/input e-katalog');
    }
    public function daftar_kontrak_e_katalog()
    {
        $eKatalogModel = new E_katalogModel();
        $pembayaranModel = new E_katalogPembayaranModel();
        $itemModel = new LainlainModel();

        $kontrakList = $eKatalogModel->findAll();

        $kontrakSP = [];
        $kontrakSPMK = [];
        $kontrakSPP = [];

    foreach ($kontrakList as $kontrak) {
        $kontrak['pembayaran'] = $pembayaranModel->where('id_kontrak', $kontrak['id'])->first();
        $kontrak['items'] = $itemModel->where('id_kontrak', $kontrak['id'])->findAll();

        if (!empty($kontrak['nomor_sp'])) {
            $kontrakSP[] = $kontrak;
        } elseif (!empty($kontrak['nomor_spmk'])) {
            $kontrakSPMK[] = $kontrak;
        } elseif (!empty($kontrak['nomor_spp'])) {
            $kontrakSPP[] = $kontrak;
        }
    }

    return view('kontrak/lihat kontrak e-katalog', [
        'kontrakSP' => $kontrakSP,
        'kontrakSPMK' => $kontrakSPMK,
        'kontrakSPP' => $kontrakSPP
    ]);
    }

    public function detail($id)
    {
        $eKatalogModel = new E_katalogModel();
        $pembayaranModel = new E_katalogPembayaranModel();
        $itemModel = new LainlainModel();

        // Ambil data kontrak berdasarkan ID
        $kontrak = $eKatalogModel->find($id);

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$kontrak) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Kontrak tidak ditemukan.');
        }

        // Ambil data pembayaran dan item terkait
        $pembayaran = $pembayaranModel->where('id_kontrak', $id)->first();
        $items = $itemModel->where('id_kontrak', $id)->findAll();

        $data = [
            'kontrak' => $kontrak,
            'pembayaran' => $pembayaran,
            'items' => $items
        ];

        return view('kontrak/detail kontrak', $data);
    }

    public function pembayaran()
    {
        $session = session();

        $nomor_kontrak = $this->request->getPost('nomor_sp') ?: 
                      $this->request->getPost('nomor_spmk') ?: 
                      $this->request->getPost('nomor_spp');

        $tgl_kontrak = $this->request->getPost('tgl_sp') ?: 
                   $this->request->getPost('tgl_spmk') ?: 
                   $this->request->getPost('tgl_spp');

        $session->set('e_katalog', [
            'nama' => $this->request->getPost('nama'),
            'nomor_sp' => $this->request->getPost('nomor_sp'),
            'nomor_spmk' => $this->request->getPost('nomor_spmk'),
            'nomor_spp' => $this->request->getPost('nomor_spp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'tgl_spmk' => $this->request->getPost('tgl_spmk'),
            'tgl_spp' => $this->request->getPost('tgl_spp'),
            'tgl_delivery' => $this->request->getPost('tgl_delivery'),
            'lama_pekerjaan' => $this->request->getPost('lama_pekerjaan'),
            'nilai_kontrak' => $this->request->getPost('nilai_kontrak'),
            'terbilang' => $this->request->getPost('terbilang'),
            'nomor_kontrak'   => $nomor_kontrak,
            'tgl_kontrak'     => $tgl_kontrak
        ]);

        return redirect()->to(base_url('kontrak/e-katalog/pembayaran'));
    }

    public function e_katalog_termin()
    {
        $session = session();
        $data = [
            'e_katalog' => $session->get('e_katalog')
        ];
        return view('kontrak/e-katalog/input e-katalog_2',$data);
    }

    public function e_katalog_termin_submit()
    {
        $session = session();

        $session->set('pembayaran', [
            'pagu' => $this->request->getPost('pagu'),
            'metode' => $this->request->getPost('metode'),
            'jumlah_termin' => $this->request->getPost('jumlah_termin'),
            'sumber_dana' => $this->request->getPost('sumber_dana')
        ]);

        return redirect()->to(base_url('kontrak/e-katalog/pembayaran/termin'));
    }


    public function e_katalog_item()
    {
        $session = session();
        $data = [
            'e_katalog' => $session->get('e_katalog'), 
            'pembayaran' => $session->get('pembayaran'), 
            'item' => $session->get('item')
          ];
        return view('kontrak/e-katalog/input e-katalog_3',$data);
    }
    public function review()
    {
        $session = session();

        $data = [
            'e_katalog' => $session->get('e_katalog'),
            'pembayaran' => $session->get('pembayaran'),
            'item' => $session->get('item'),
        ];

        return view('kontrak/e-katalog/review', $data);
    }

    public function e_katalog_item_submit()
    {
        $session = session();
        
        $eKatalogModel = new E_katalogModel();
        $pembayaranModel = new E_katalogPembayaranModel();
        $itemModel = new LainlainModel();

        $e_katalog = $session->get('e_katalog');
        $pembayaran = $session->get('pembayaran');

        if (!$e_katalog || !$pembayaran) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Data session tidak ditemukan.');
        }

        if (!$eKatalogModel->insert($e_katalog)) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Gagal menyimpan data kontrak.');
        }

        $id_kontrak = $eKatalogModel->getInsertID();

        if (!$id_kontrak) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Gagal mendapatkan ID kontrak.');
        }

        $pembayaran['id_kontrak'] = $id_kontrak;
        if (!$pembayaranModel->insert($pembayaran)) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Gagal menyimpan data pembayaran.');
        }

        $itemData = [
            'id_kontrak' => $id_kontrak,
            'kode_paket' => $this->request->getPost('kode_paket'),
            'kode_item' => $this->request->getPost('kode_item'),
            'nama_item' => $this->request->getPost('nama_item'),
            'kuantitas' => $this->request->getPost('kuantitas'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'penyedia' => $this->request->getPost('penyedia')
        ];

        if (!$itemModel->insert($itemData)) {
            return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Gagal menyimpan data item.');
        }

        $session->remove(['e_katalog', 'pembayaran']);

        return redirect()->to(base_url('kontrak/e-katalog/success'))->with('success', 'Data berhasil disimpan.');
    }


    public function success()
    {
        return view('kontrak/e-katalog/success');
    }    
    public function pl()
    {
      return view('kontrak/pl/input pl');
    }
    public function tender()
    {
      return view('kontrak/tender/input tender');
    }
    
}
