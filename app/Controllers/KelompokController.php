<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KelompokModel;
use App\Models\AkunModel;
class KelompokController extends BaseController
{
    protected $KelompokModel;
    protected $AkunModel;
    public function __construct()
    {
        $this->KelompokModel = new KelompokModel();
        $this->AkunModel = new AkunModel();
    }

    public function index()
    {
        $data['kelompok'] = $this->KelompokModel->getData();

        return view('kelompok/index', $data);
    }

    public function create()
    {
        $data['akun'] = $this->AkunModel->findAll();
        return view('kelompok/create', $data);
    }

    public function store()
    {
        $data = [
            'id_akun' => $this->request->getPost('id_akun'),
            'kode_kelompok' => $this->request->getPost('kode_kelompok'),
            'uraian_kelompok' => $this->request->getPost('uraian_kelompok'),
            'tahun' => session()->get('tahun'),
        ];

        $this->KelompokModel->insert($data);

        return redirect()->to('/kelompok');
    }


    public function edit($id)
    {
        $data = [
            'kelompok' => $this->KelompokModel->find($id),
            'akun' => $this->AkunModel->findAll()
        ];
        return view('kelompok/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_akun' => $this->request->getPost('id_akun'),
            'kode_kelompok' => $this->request->getPost('kode_kelompok'),
            'uraian_kelompok' => $this->request->getPost('uraian_kelompok'),
        ];

        $this->KelompokModel->update($id, $data);

        return redirect()->to('kelompok');
    }

    public function destroy($id)
    {
        $this->KelompokModel->delete($id);

        return redirect()->to('/kelompok');
    }
}
