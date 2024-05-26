<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UrusanModel;
use App\Models\BidangUrusanModel;
use App\Models\ProgramModel;
use App\Models\KegiatanModel;
class KegiatanController extends BaseController
{
    protected $UrusanModel;
    protected $ProgramModel;
    protected $BidangUrusanModel;
    protected $KegiatanModel;
    public function __construct()
    {
        $this->UrusanModel = new UrusanModel();
        $this->BidangUrusanModel = new BidangUrusanModel();
        $this->ProgramModel = new ProgramModel();
        $this->KegiatanModel = new KegiatanModel();

    }

    // public function index()
    // {
    //     $data['program'] = $this->ProgramModel->getBidangUrusan();
    //     return view('program/index', $data);
    // }

    public function index()
    {
        $kegiatan = $this->KegiatanModel->getKegiatan();

        return view('kegiatan/index', ['kegiatan' => $kegiatan]);
    }


    public function create()
    {
        $data = [
            'program' => $this->ProgramModel->findAll(),
        ];
        return view('kegiatan/create', $data);
    }

    public function store()
    {
        $data = [
            // 'id_urusan' => $this->request->getPost('id_urusan'),
            // 'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            'id_program' => $this->request->getPost('id_program'),
            'kode_kegiatan' => $this->request->getPost('kode_kegiatan'),
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
        ];

        $this->KegiatanModel->insert($data);

        return redirect()->to('/kegiatan');
    }


    public function edit($id)
    {
        $data = [
            'kegiatan' => $this->KegiatanModel->find($id),
            'program' => $this->ProgramModel->find(),
            // 'bidang_urusan' => $this->BidangUrusanModel->findAll(),
            // 'urusan' => $this->UrusanModel->findAll(),
        ];
        return view('kegiatan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            // 'id_urusan' => $this->request->getPost('id_urusan'),
            // 'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            'id_program' => $this->request->getPost('id_program'),
            'kode_kegiatan' => $this->request->getPost('kode_kegiatan'),
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
        ];

        $this->KegiatanModel->update($id, $data);

        return redirect()->to('kegiatan');
    }

    public function destroy($id)
    {
        $this->KegiatanModel->delete($id);

        return redirect()->to('/kegiatan');
    }


    // AJAX METHOD FOR DEPENDENT DROPDOWN / CHAINED SELECT OPTION
    // public function getBidangUrusan($id)
    // {
    //     $data = $this->BidangUrusanModel->where('id_urusan', $id)->findAll();
    //     return json_encode($data);
    // }

    // public function getProgram($id)
    // {
    //     $data = $this->ProgramModel->where('id_bidang_urusan', $id)->findAll();
    //     return json_encode($data);
    // }
}
