<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UrusanModel;
class UrusanController extends BaseController
{
    protected $UrusanModel;
    public function __construct()
    {
        $this->UrusanModel = new UrusanModel();

    }

    public function index()
    {
        $data['urusan'] = $this->UrusanModel->findAll();
        return view('urusan/index', $data);
    }

    public function create()
    {
        return view('urusan/create');
    }

    public function store()
    {
        $data = [
            'kode_urusan' => $this->request->getPost('kode_urusan'),
            'nama_urusan' => $this->request->getPost('nama_urusan'),
            'tahun' => session()->get('tahun'),
        ];

        $this->UrusanModel->insert($data);

        return redirect()->to('/urusan');
    }


    public function edit($id)
    {
        $data = [
            'urusan' => $this->UrusanModel->find($id),
        ];
        return view('urusan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode_urusan' => $this->request->getPost('kode_urusan'),
            'nama_urusan' => $this->request->getPost('nama_urusan'),
        ];

        $this->UrusanModel->update($id, $data);

        return redirect()->to('urusan');
    }

    public function destroy($id)
    {
        $this->UrusanModel->delete($id);

        return redirect()->to('/urusan');
    }
}
