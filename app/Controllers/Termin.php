<?php

namespace App\Controllers;
use App\Models\TerminModel;
use CodeIgniter\Controller;

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
      return view('termin/data kontrak');
    }

    public function save()
    {
        $model = new TerminModel();
        $model->save([
            'kontrak_id' => $this->request->getPost('nama_kontrak'),
            'jumlah' => $this->request->getPost('nilai'),
            'tgl_pembayaran' => $this->request->getPost('tanggal'),
            'termin_ke' => $this->request->getPost('termin_ke'),
        ]);
        return redirect()->to('input_termin');
    }

    public function delete($id)
    {
        $model = new TerminModel();
        $model->delete($id);
        return redirect()->to('input_termin');
    }
}
