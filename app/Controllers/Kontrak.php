<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\E_katalogModel;

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
    public function pembayaran()
    {
        $session = session();

        // Simpan data kontrak ke session
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
            'terbilang' => $this->request->getPost('terbilang')
        ]);

        return redirect()->to(base_url('kontrak/e-katalog/pembayaran'));
    }

    public function e_katalog_termin()
    {
        $session = session();
        $data = [
            'e_katalog' => $session->get('e_katalog') // Ambil session E-Katalog
        ];
        return view('kontrak/e-katalog/input e-katalog_2',$data);
    }

    public function e_katalog_termin_submit()
    {
        $session = session();

        // Simpan data pembayaran ke session
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
            'e_katalog' => $session->get('e_katalog'), // Ambil session E-Katalog
            'pembayaran' => $session->get('pembayaran') // Ambil session Pembayaran
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
        $db = db_connect();

        // Ambil semua data dari session
        $e_katalog = $session->get('e_katalog');
        $pembayaran = $session->get('pembayaran');

        // Simpan data ke database
        $builder = $db->table('e_katalog');
        $builder->insert($e_katalog);
        $id_kontrak = $db->insertID();

        // Simpan pembayaran dengan ID kontrak
        $pembayaran['id_kontrak'] = $id_kontrak;
        $db->table('pembayaran')->insert($pembayaran);

        // Simpan item kontrak dengan ID kontrak
        $db->table('item_kontrak')->insert([
            'id_kontrak' => $id_kontrak,
            'kode_paket' => $this->request->getPost('kode_paket'),
            'kode_item' => $this->request->getPost('kode_item'),
            'nama_item' => $this->request->getPost('nama_item'),
            'kuantitas' => $this->request->getPost('kuantitas'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'penyedia' => $this->request->getPost('penyedia')
        ]);

        // Hapus session setelah data tersimpan
        $session->remove(['e_katalog', 'pembayaran']);

        return redirect()->to(base_url('kontrak/e-katalog/success'));
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
