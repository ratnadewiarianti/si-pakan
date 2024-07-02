<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AkunModel;
class AkunController extends BaseController
{
    protected $AkunModel;
    public function __construct()
    {
        $this->AkunModel = new AkunModel();

    }

    public function index()
    {
        $data['akun'] = $this->AkunModel->findAll();
        return view('akun/index', $data);
    }

    public function create()
    {
        return view('akun/create');
    }

    public function store()
    {
        $data = [
            'kode_akun' => $this->request->getPost('kode_akun'),
            'uraian_akun' => $this->request->getPost('uraian_akun'),
            'tahun' => session()->get('tahun'),
        ];

        $this->AkunModel->insert($data);

        return redirect()->to('/akun');
    }


    public function edit($id)
    {
        $data = [
            'akun' => $this->AkunModel->find($id),
        ];
        return view('akun/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode_akun' => $this->request->getPost('kode_akun'),
            'uraian_akun' => $this->request->getPost('uraian_akun'),
        ];

        $this->AkunModel->update($id, $data);

        return redirect()->to('akun');
    }

    public function destroy($id)
    {
        $this->AkunModel->delete($id);

        return redirect()->to('/akun');
    }
}
