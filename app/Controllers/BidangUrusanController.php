<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BidangUrusanModel;
use App\Models\UrusanModel;
class BidangUrusanController extends BaseController
{
    protected $BidangUrusanModel;
    protected $UrusanModel;
    public function __construct()
    {
        $this->BidangUrusanModel = new BidangUrusanModel();
        $this->UrusanModel = new UrusanModel();
    }

    public function index()
    {
        $bidang_urusan = $this->BidangUrusanModel->getBidangUrusan();


        return view('bidang_urusan/index', ['bidang_urusan' => $bidang_urusan]);
    }

    public function create()
    {
        $data['urusan'] = $this->UrusanModel->findAll();
        return view('bidang_urusan/create', $data);
    }

    public function store()
    {
        $data = [
            'id_urusan' => $this->request->getPost('id_urusan'),
            'kode_bidang_urusan' => $this->request->getPost('kode_bidang_urusan'),
            'nama_bidang_urusan' => $this->request->getPost('nama_bidang_urusan'),
            'tahun' => session()->get('tahun'),
        ];

        $this->BidangUrusanModel->insert($data);

        return redirect()->to('/bidang_urusan');
    }


    public function edit($id)
    {
        $data = [
            'bidang_urusan' => $this->BidangUrusanModel->find($id),
            'urusan' => $this->UrusanModel->findAll()
        ];
        return view('bidang_urusan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_urusan' => $this->request->getPost('id_urusan'),
            'kode_bidang_urusan' => $this->request->getPost('kode_bidang_urusan'),
            'nama_bidang_urusan' => $this->request->getPost('nama_bidang_urusan'),
        ];

        $this->BidangUrusanModel->update($id, $data);

        return redirect()->to('bidang_urusan');
    }

    public function destroy($id)
    {
        $this->BidangUrusanModel->delete($id);

        return redirect()->to('/bidang_urusan');
    }
}
