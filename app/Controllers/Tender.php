<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TenderModel;

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
}
