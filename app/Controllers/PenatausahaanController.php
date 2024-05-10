<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenatausahaanModel;
use App\Models\KaryawanModel;
class PenatausahaanController extends BaseController
{
    protected $PenataUsahaanModel;
    protected $KaryawanModel;
    public function __construct()
    {
        $this->PenataUsahaanModel = new PenataUsahaanModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data['penatausahaan'] = $this->PenataUsahaanModel->getPenatausahaan();
        return view('penatausahaan/index', $data);
    }

    public function create()
    {
        $data['karyawan'] = $this->KaryawanModel->findAll();
        return view('penatausahaan/create', $data);
    }

    public function store()
    {
        $data = [
            'link_google' => $this->request->getPost('link_google'),
            'karyawan_1' => $this->request->getPost('karyawan_1'),
            'karyawan_2' => $this->request->getPost('karyawan_2'),
            'karyawan_3' => $this->request->getPost('karyawan_3'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];

        $this->PenataUsahaanModel->insert($data);

        return redirect()->to('/penatausahaan');
    }


    public function edit($id)
    {
        $data = [
            'penatausahaan' => $this->PenataUsahaanModel->find($id),
           'karyawan' => $this->KaryawanModel->findAll()
        ];
        return view('penatausahaan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'link_google' => $this->request->getPost('link_google'),
            'karyawan_1' => $this->request->getPost('karyawan_1'),
            'karyawan_2' => $this->request->getPost('karyawan_2'),
            'karyawan_3' => $this->request->getPost('karyawan_3'),
            'tanggal' => $this->request->getPost('tanggal'),
        ];

        $this->PenataUsahaanModel->update($id, $data);

        return redirect()->to('penatausahaan');
    }

    public function destroy($id)
    {
        $this->PenataUsahaanModel->delete($id);

        return redirect()->to('/penatausahaan');
    }
}
