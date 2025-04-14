<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\TenderModel;
use App\Models\TenderPembayaranModel;
use App\Models\TenderLainlainModel;
use App\Models\DirekturModel;

class Tender extends BaseController
{
    public function tender()
    {
      return view('kontrak/tender/input tender');
    }
    public function pembayaran()
    {
      $session = session();

      $nomor_kontrak = $this->request->getPost('nomor_perjanjian') ?: 
                    $this->request->getPost('nomor_spmk'); 

      $tgl_kontrak = $this->request->getPost('tgl_perjanjian') ?: 
                 $this->request->getPost('tgl_spmk'); 

      $session->set('tender', [
          'nama' => $this->request->getPost('nama'),
          'nomor_perjanjian' => $this->request->getPost('nomor_perjanjian'),
          'nomor_spmk' => $this->request->getPost('nomor_spmk'),
          'tgl_perjanjian' => $this->request->getPost('tgl_perjanjian'),
          'tgl_spmk' => $this->request->getPost('tgl_spmk'),
          'tgl_delivery' => $this->request->getPost('tgl_delivery'),
          'lama_pekerjaan' => $this->request->getPost('lama_pekerjaan'),
          'nilai_kontrak' => $this->request->getPost('nilai_kontrak'),
          'terbilang' => $this->request->getPost('terbilang'),
          'nomor_kontrak'   => $nomor_kontrak,
          'tgl_kontrak'     => $tgl_kontrak
      ]);

      return redirect()->to(base_url('kontrak/tender/pembayaran'));
    }

    public function tender_termin()
    {
        $session = session();
        $data = [
            'tender' => $session->get('tender')
        ];
        return view('kontrak/tender/input tender_2',$data);
    }

    public function tender_termin_submit()
    {
        $session = session();

        $session->set('tender_pembayaran', [
            'pagu' => $this->request->getPost('pagu'),
            'metode' => $this->request->getPost('metode'),
            'jumlah_termin' => $this->request->getPost('jumlah_termin'),
            'sumber_dana' => $this->request->getPost('sumber_dana')
        ]);

        return redirect()->to(base_url('kontrak/tender/pembayaran/termin'));
    }

    public function tender_item()
    {
        $session = session();
        $data = [
            'tender' => $session->get('tender'), 
            'tender_pembayaran' => $session->get('tender_pembayaran'), 
            'tender_item' => $session->get('tender_item')
          ];
        return view('kontrak/tender/input tender_3',$data);
    }
    public function tender_item_submit()
    {
        $session = session();
        
        $TenderModel = new TenderModel();
        $pembayaranModel = new TenderPembayaranModel();
        $itemModel = new TenderLainlainModel();

        $tender = $session->get('tender');
        $pembayaran = $session->get('tender_pembayaran');

        if (!$tender || !$pembayaran) {
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Data session tidak ditemukan.');
        }

        if (!$TenderModel->insert($tender)) {
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Gagal menyimpan data kontrak.');
        }

        $id_kontrak = $TenderModel->getInsertID();

        if (!$id_kontrak) {
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Gagal mendapatkan ID kontrak.');
        }

        $pembayaran['id_kontrak'] = $id_kontrak;
        if (!$pembayaranModel->insert($pembayaran)) {
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Gagal menyimpan data pembayaran.');
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
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Gagal menyimpan data item.');
        }

        $session->remove(['tender', 'pembayaran']);

        return redirect()->to(base_url('kontrak/tender/success'))->with('success', 'Data berhasil disimpan.');
    }
    public function success()
    {
        return view('kontrak/tender/success');
    }
    
    public function daftar_kontrak_tender()
    {
        $TenderModel = new TenderModel();
        $pembayaranModel = new TenderPembayaranModel();
        $itemModel = new TenderLainlainModel();

        $kontrakList = $TenderModel->findAll();

        $kontrakPerjanjian = [];
        $kontrakSPMK = [];

    foreach ($kontrakList as $kontrak) {
        $kontrak['pembayaran'] = $pembayaranModel->where('id_kontrak', $kontrak['id'])->first();
        $kontrak['items'] = $itemModel->where('id_kontrak', $kontrak['id'])->findAll();

        if (!empty($kontrak['nomor_perjanjian'])) {
            $kontrakPerjanjian[] = $kontrak;
        } elseif (!empty($kontrak['nomor_spmk'])) {
            $kontrakSPMK[] = $kontrak;
        }
    }

    return view('kontrak/lihat kontrak tender', [
        'kontrakPerjanjian' => $kontrakPerjanjian,
        'kontrakSPMK' => $kontrakSPMK
    ]);
    }

    public function detail($id)
    {
        $TenderModel = new TenderModel();
        $pembayaranModel = new TenderPembayaranModel();
        $itemModel = new TenderLainlainModel();

        // Ambil data kontrak berdasarkan ID
        $kontrak = $TenderModel->find($id);

        // Jika tidak ditemukan, redirect dengan pesan error
        if (!$kontrak) {
            return redirect()->to(base_url('kontrak/tender'))->with('error', 'Kontrak tidak ditemukan.');
        }

        // Ambil data pembayaran dan item terkait
        $pembayaran = $pembayaranModel->where('id_kontrak', $id)->first();
        $items = $itemModel->where('id_kontrak', $id)->findAll();

        $data = [
            'kontrak' => $kontrak,
            'pembayaran' => $pembayaran,
            'items' => $items
        ];

        return view('kontrak/detail tender', $data);
    }

    public function generatePerjanjian($id)
    {
    $TenderModel = new TenderModel();
    $pembayaranModel = new TenderPembayaranModel();
    $itemModel = new TenderLainlainModel();
    $direkturModel = new DirekturModel();

    $tender = $TenderModel->find($id);
    $pembayaran = $pembayaranModel->where('id_kontrak', $id)->first();
    $items = $itemModel->where('id_kontrak', $id)->findAll();

    $firstItem = $itemModel->where('id_kontrak', $id)->first();
    $nama_penyedia = $firstItem['penyedia'] ?? '-';

    $nama_penyedia = $firstItem['penyedia'] ?? '-';

    $direktur = $direkturModel->first();

    if (!$tender) {
        return redirect()->to(base_url('kontrak/tender'))->with('error', 'Kontrak tidak ditemukan.');
    }

    $nama_direktur = $direktur['nama_direktur'] ?? '-';
    $jabatan_direktur = $direktur['jabatan_direktur'] ?? '-';
    $alamat_penyedia = $direktur['alamat_penyedia'] ?? '-';

    $templatePath = WRITEPATH . 'uploads/Salinan sp.docx';
    $savePath = WRITEPATH . 'generated/SP_' . $tender['id'] . '.docx';

    $templateProcessor = new TemplateProcessor($templatePath);

    // 🔹 Set nilai utama
    $templateProcessor->setValue('kode_paket', $items[0]['kode_paket'] ?? '-');
    $templateProcessor->setValue('no_sp', $tender['nomor_kontrak'] ?? '-');
    $templateProcessor->setValue('tgl_sp', $tender['tgl_kontrak'] ?? '-');
    $templateProcessor->setValue('nama_pengadaan', $tender['nama']);
    $templateProcessor->setValue('tgl_pengiriman', $tender['tgl_delivery'] ?? '-');
    $templateProcessor->setValue('total', number_format($tender['nilai_kontrak'], 0, ',', '.'));
    $templateProcessor->setValue('terbilang', $tender['terbilang'] ?? '-');
    $templateProcessor->setValue('nama_direktur', $nama_direktur);
    $templateProcessor->setValue('jabatan_direktur', $jabatan_direktur);
    $templateProcessor->setValue('alamat_penyedia', $alamat_penyedia);
    $templateProcessor->setValue('nama_penyedia', $nama_penyedia);

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
    return $this->response->download($savePath, null)->setFileName('Surat_Pesanan_' . $tender['id'] . '.docx');
    }
    
    public function generateSPMK($id)
    {
    $TenderModel = new TenderModel();
    $pembayaranModel = new TenderPembayaranModel();
    $itemModel = new TenderLainlainModel();
    $direkturModel = new DirekturModel();

    $e_katalog = $TenderModel->find($id);
    $pembayaran = $pembayaranModel->where('id_kontrak', $id)->first();
    $items = $itemModel->where('id_kontrak', $id)->findAll();

    $firstItem = $itemModel->where('id_kontrak', $id)->first();
    $nama_penyedia = $firstItem['penyedia'] ?? '-';

    $nama_penyedia = $firstItem['penyedia'] ?? '-';

    $direktur = $direkturModel->first();

    $lama = $e_katalog['lama_pekerjaan'] ?? 0;
    $lama_hari = $this->convertHariToWords($lama);
    $hasil_pekerjaan = 'Terpenuhinya kebutuhan ' . strtolower($e_katalog['nama']);

    if (!$e_katalog) {
        return redirect()->to(base_url('kontrak/e-katalog'))->with('error', 'Kontrak tidak ditemukan.');
    }

    $nama_direktur = $direktur['nama_direktur'] ?? '-';
    $jabatan_direktur = $direktur['jabatan_direktur'] ?? '-';
    $alamat_penyedia = $direktur['alamat_penyedia'] ?? '-';

    $templatePath = WRITEPATH . 'uploads/spmk.docx';
    $savePath = WRITEPATH . 'generated/SPMK_' . $e_katalog['id'] . '.docx';

    $templateProcessor = new TemplateProcessor($templatePath);

    // 🔹 Set nilai utama
    $templateProcessor->setValue('no_sp', $e_katalog['no_sp'] ?? '-');
    $templateProcessor->setValue('no_spmk', $e_katalog['nomor_spmk'] ?? '-');
    $templateProcessor->setValue('tgl_sp', $e_katalog['tgl_sp'] ?? '-');
    $templateProcessor->setValue('nama_pengadaan', $e_katalog['nama']);
    $templateProcessor->setValue('tgl_pengiriman', $e_katalog['tgl_delivery'] ?? '-');
    $templateProcessor->setValue('total', number_format($e_katalog['nilai_kontrak'], 0, ',', '.'));
    $templateProcessor->setValue('terbilang', $e_katalog['terbilang'] ?? '-');
    $templateProcessor->setValue('nama_direktur', $nama_direktur);
    $templateProcessor->setValue('jabatan_direktur', $jabatan_direktur);
    $templateProcessor->setValue('alamat_penyedia', $alamat_penyedia);
    $templateProcessor->setValue('nama_penyedia', $nama_penyedia);
    $templateProcessor->setValue('lama', $lama);
    $templateProcessor->setValue('lama_hari', $lama_hari);
    $templateProcessor->setValue('hasil_pekerjaan', $hasil_pekerjaan);

    // 🔹 Simpan dan download
    $templateProcessor->saveAs($savePath);
    return $this->response->download($savePath, null)->setFileName('Surat_Pesanan_' . $e_katalog['id'] . '.docx');
    }

    private function convertHariToWords($number)
    {
    $f = new \NumberFormatter("id", \NumberFormatter::SPELLOUT);
    return ucfirst($f->format($number));
    }
}
