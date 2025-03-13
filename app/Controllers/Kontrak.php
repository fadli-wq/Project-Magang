<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\E_katalogModel;
use App\Models\LainlainModel;
use App\Models\E_katalogPembayaranModel;
use App\Models\DIrekturModel;

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

    public function generateSP($id)
    {
    $eKatalogModel = new E_katalogModel();
    $pembayaranModel = new E_katalogPembayaranModel();
    $itemModel = new LainlainModel();
    $direkturModel = new DirekturModel();

    $e_katalog = $eKatalogModel->find($id);
    $pembayaran = $pembayaranModel->where('id_kontrak', $id)->first();
    $items = $itemModel->where('id_kontrak', $id)->findAll();

    $direktur = $direkturModel->first();
    
    if (!$e_katalog) {
        return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Kontrak tidak ditemukan.');
    }

    $nama_direktur = $direktur['nama_direktur'] ?? '-';
    $jabatan_direktur = $direktur['jabatan_direktur'] ?? '-';
    $alamat_penyedia = $direktur['alamat_penyedia'] ?? '-';

    $templatePath = WRITEPATH . 'uploads/Salinan sp.docx';
    $savePath = WRITEPATH . 'generated/SP_' . $e_katalog['id'] . '.docx';

    $templateProcessor = new TemplateProcessor($templatePath);

    // 🔹 Set nilai utama
    $templateProcessor->setValue('kode_paket', $items[0]['kode_paket'] ?? '-');
    $templateProcessor->setValue('no_sp', $e_katalog['nomor_kontrak'] ?? '-');
    $templateProcessor->setValue('tgl_sp', $e_katalog['tgl_kontrak'] ?? '-');
    $templateProcessor->setValue('nama_pengadaan', $e_katalog['nama']);
    $templateProcessor->setValue('tgl_pengiriman', $e_katalog['tgl_delivery'] ?? '-');
    $templateProcessor->setValue('total', number_format($e_katalog['nilai_kontrak'], 0, ',', '.'));
    $templateProcessor->setValue('terbilang', $e_katalog['terbilang'] ?? '-');
    $templateProcessor->setValue('nama_direktur', $nama_direktur);
    $templateProcessor->setValue('jabatan_direktur', $jabatan_direktur);
    $templateProcessor->setValue('alamat_penyedia', $alamat_penyedia);

    // 🔹 Clone Row untuk item
    if (!empty($items)) {
        $templateProcessor->cloneRow('tabelx', count($items));

        foreach ($items as $index => $item) {
            $row = $index + 1;
            $templateProcessor->setValue("kode_item#$row", $item['kode_item'] ?? '-');
            $templateProcessor->setValue("nama_item#$row", $item['nama_item'] ?? '-');
            $templateProcessor->setValue("kuantitas#$row", number_format($item['kuantitas'], 2, ',', '.'));
            $templateProcessor->setValue("satuan#$row", number_format($item['harga_satuan'], 0, ',', '.'));
            $templateProcessor->setValue("harga_kirim#$row", number_format($item['harga_kirim'] ?? 0, 0, ',', '.'));
            $templateProcessor->setValue("tgl_pengiriman#$row", $item['tgl_pengiriman'] ?? '-');
            $templateProcessor->setValue("total#$row", number_format($item['kuantitas'] * $item['harga_satuan'], 0, ',', '.'));
        }
    }

    // 🔹 Simpan dan download
    $templateProcessor->saveAs($savePath);
    return $this->response->download($savePath, null)->setFileName('Surat_Pesanan_' . $e_katalog['id'] . '.docx');
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
