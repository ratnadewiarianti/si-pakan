<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KegiatanModel;
use App\Models\SubkegiatanModel;
class SubkegiatanController extends BaseController
{
    // protected $UrusanModel;
    // protected $ProgramModel;
    // protected $BidangUrusanModel;
    protected $KegiatanModel;
    protected $SubkegiatanModel;
    public function __construct()
    {
        $this->KegiatanModel = new KegiatanModel();
        $this->SubkegiatanModel = new SubkegiatanModel();

    }

    public function index()
    {
        $subkegiatan = $this->SubkegiatanModel->getSubkegiatan();

        return view('subkegiatan/index', ['subkegiatan' => $subkegiatan]);
    }


    public function create()
    {
        $data = [
            'kegiatan' => $this->KegiatanModel->findAll(),
        ];
        return view('subkegiatan/create', $data);
    }

    public function store()
    {
        $data = [
            // 'id_urusan' => $this->request->getPost('id_urusan'),
            // 'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            // 'id_program' => $this->request->getPost('id_program'),
            'id_kegiatan' => $this->request->getPost('id_kegiatan'),
            'kode_subkegiatan' => $this->request->getPost('kode_subkegiatan'),
            'nama_subkegiatan' => $this->request->getPost('nama_subkegiatan'),
            'bidang' => $this->request->getPost('bidang'),
            'kode_bidang' => $this->request->getPost('kode_bidang'),
        ];

        $this->SubkegiatanModel->insert($data);

        return redirect()->to('/subkegiatan');
    }


    public function edit($id)
    {
        $data = [
            'subkegiatan' => $this->SubkegiatanModel->find($id),
            'kegiatan' => $this->KegiatanModel->find(),
            // 'program' => $this->ProgramModel->find($id),
            // 'bidang_urusan' => $this->BidangUrusanModel->findAll(),
            // 'urusan' => $this->UrusanModel->findAll(),
        ];
        return view('subkegiatan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_urusan' => $this->request->getPost('id_urusan'),
            'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            'id_program' => $this->request->getPost('id_program'),
            'id_kegiatan' => $this->request->getPost('id_kegiatan'),
            'kode_subkegiatan' => $this->request->getPost('kode_subkegiatan'),
            'nama_subkegiatan' => $this->request->getPost('nama_subkegiatan'),
            'bidang' => $this->request->getPost('bidang'),
            'kode_bidang' => $this->request->getPost('kode_bidang'),
        ];

        $this->SubkegiatanModel->update($id, $data);

        return redirect()->to('subkegiatan');
    }

    public function destroy($id)
    {
        $this->SubkegiatanModel->delete($id);

        return redirect()->to('/subkegiatan');
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

    // public function getKegiatan($id)
    // {
    //     $data = $this->KegiatanModel->where('id_program', $id)->findAll();
    //     return json_encode($data);
    // }
}
