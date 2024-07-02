<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JenisModel;
use App\Models\KelompokModel;
class JenisController extends BaseController
{
    protected $KelompokModel;
    protected $JenisModel;
    public function __construct()
    {
        $this->KelompokModel = new KelompokModel();
        $this->JenisModel = new JenisModel();
    }

    public function index()
    {
        $data['jenis'] = $this->JenisModel->getData();
        return view('jenis/index', $data);
    }

    public function create()
    {
        $data['kelompok'] = $this->KelompokModel->getData();
        return view('jenis/create', $data);
    }

    public function store()
    {
        $data = [
            'id_kelompok' => $this->request->getPost('id_kelompok'),
            'kode_jenis' => $this->request->getPost('kode_jenis'),
            'uraian_jenis' => $this->request->getPost('uraian_jenis'),
            'tahun' => session()->get('tahun'),
        ];

        $this->JenisModel->insert($data);

        return redirect()->to('/jenis');
    }


    public function edit($id)
    {
        $data = [
            'jenis' => $this->JenisModel->find($id),
            'kelompok' => $this->KelompokModel->getData()
        ];
        return view('jenis/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_kelompok' => $this->request->getPost('id_kelompok'),
            'kode_jenis' => $this->request->getPost('kode_jenis'),
            'uraian_jenis' => $this->request->getPost('uraian_jenis'),
        ];

        $this->JenisModel->update($id, $data);

        return redirect()->to('jenis');
    }

    public function destroy($id)
    {
        $this->JenisModel->delete($id);

        return redirect()->to('/jenis');
    }
}
