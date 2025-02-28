<?php

namespace App\Controllers;
use App\Models\TerminModel;
use CodeIgniter\Controller;

class Termin extends Controller
{
    public function index()
    {
        $model = new TerminModel();
        $data['termins'] = $model->findAll();
        return view('termin/input termin', $data);
    }

    public function save()
    {
        $model = new TerminModel();
        $model->save([
            'kontrak_id' => $this->request->getPost('nama_kontrak'),
            'jumlah' => $this->request->getPost('nilai'),
            'tgl_pembayaran' => $this->request->getPost('tanggal')
        ]);
        return redirect()->to('termin');
    }

    public function delete($id)
    {
        $model = new TerminModel();
        $model->delete($id);
        return redirect()->to('/termin');
    }
}
