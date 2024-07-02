<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataRekeningModel;

class DataRekeningController extends BaseController
{
    protected $DataRekeningModel;

    public function __construct()
    {
        $this->DataRekeningModel = new DataRekeningModel();
    }

    public function index()
    {
        $data['datarekening'] = $this->DataRekeningModel->findAll();
        return view('datarekening/index', $data);
    }

    public function create()
    {
        return view('datarekening/create');
    }

    public function store()
    {
        $data = [
            'akun' => $this->request->getPost('akun'),
            'kelompok' => $this->request->getPost('kelompok'),
            'jenis' => $this->request->getPost('jenis'),
            'objek' => $this->request->getPost('objek'),
            'rincian_object' => $this->request->getPost('rincian_object'),
            'sub_rincian_objek' => $this->request->getPost('sub_rincian_objek'),
            'uraian_akun' => $this->request->getPost('uraian_akun'),
            'tahun' => session()->get('tahun'),

        ];

        $this->DataRekeningModel->insert($data);

        return redirect()->to('/datarekening');
    }

    public function show($id)
    {
        $data['datarekening'] = $this->DataRekeningModel->find($id);
        return view('datarekening/show', $data);
    }

    public function edit($id)
    {
        $data['datarekening'] = $this->DataRekeningModel->find($id);
        return view('datarekening/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'akun' => $this->request->getPost('akun'),
            'kelompok' => $this->request->getPost('kelompok'),
            'jenis' => $this->request->getPost('jenis'),
            'objek' => $this->request->getPost('objek'),
            'rincian_object' => $this->request->getPost('rincian_object'),
            'sub_rincian_objek' => $this->request->getPost('sub_rincian_objek'),
            'uraian_akun' => $this->request->getPost('uraian_akun'),
        ];

        $this->DataRekeningModel->update($id, $data);

        return redirect()->to('/datarekening');
    }

    public function destroy($id)
    {
        $this->DataRekeningModel->delete($id);

        return redirect()->to('/datarekening');
    }
}
