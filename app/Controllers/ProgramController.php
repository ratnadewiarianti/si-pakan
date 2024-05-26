<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UrusanModel;
use App\Models\BidangUrusanModel;
use App\Models\ProgramModel;
class ProgramController extends BaseController
{
    protected $UrusanModel;
    protected $ProgramModel;
    protected $BidangUrusanModel;
    public function __construct()
    {
        $this->UrusanModel = new UrusanModel();
        $this->BidangUrusanModel = new BidangUrusanModel();
        $this->ProgramModel = new ProgramModel();

    }

    // public function index()
    // {
    //     $data['program'] = $this->ProgramModel->getBidangUrusan();
    //     return view('program/index', $data);
    // }

    public function index()
    {
        $program = $this->ProgramModel->getProgram();

        return view('program/index', ['program' => $program]);
    }


    public function create()
    {
        $data = [
            'bidang_urusan' => $this->BidangUrusanModel->findAll(),
        ];
        return view('program/create', $data);
    }

    public function store()
    {
        $data = [
            // 'id_urusan' => $this->request->getPost('id_urusan'),
            'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            'kode_program' => $this->request->getPost('kode_program'),
            'nama_program' => $this->request->getPost('nama_program'),
        ];

        $this->ProgramModel->insert($data);

        return redirect()->to('/program');
    }


    public function edit($id)
    {
        $data = [
            'program' => $this->ProgramModel->find($id),
            'bidang_urusan' => $this->BidangUrusanModel->findAll(),
            // 'urusan' => $this->UrusanModel->findAll(),
        ];
        return view('program/edit', $data);
    }

    public function update($id)
    {
        $data = [
            // 'id_urusan' => $this->request->getPost('id_urusan'),
            'id_bidang_urusan' => $this->request->getPost('id_bidang_urusan'),
            'kode_program' => $this->request->getPost('kode_program'),
            'nama_program' => $this->request->getPost('nama_program'),
        ];

        $this->ProgramModel->update($id, $data);

        return redirect()->to('program');
    }

    public function destroy($id)
    {
        $this->ProgramModel->delete($id);

        return redirect()->to('/program');
    }


    // AJAX METHOD FOR DEPENDENT DROPDOWN / CHAINED SELECT OPTION
    // public function getBidangUrusan($id)
    // {
    //     $data = $this->BidangUrusanModel->where('id_urusan', $id)->findAll();
    //     return json_encode($data);
    // }

    
}
