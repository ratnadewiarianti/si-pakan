<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JenisModel;
use App\Models\ObjekModel;
class ObjekController extends BaseController
{
    protected $ObjekModel;
    protected $JenisModel;
    public function __construct()
    {
        $this->ObjekModel = new ObjekModel();
        $this->JenisModel = new JenisModel();
    }   

    public function index()
    {
        $data['objek'] = $this->ObjekModel->getData();
        return view('objek/index', $data);
    }

    public function create()
    {
        $data['jenis'] = $this->JenisModel->getData();
        return view('objek/create', $data);
    }

    public function store()
    {
        $data = [
            'id_jenis' => $this->request->getPost('id_jenis'),
            'kode_objek' => $this->request->getPost('kode_objek'),
            'uraian_objek' => $this->request->getPost('uraian_objek'),
            'tahun' => session()->get('tahun'),
        ];

        $this->ObjekModel->insert($data);

        return redirect()->to('/objek');
    }


    public function edit($id)
    {
        $data = [
            'objek' => $this->ObjekModel->find($id),
            'jenis' => $this->JenisModel->getData()
        ];
        return view('objek/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_jenis' => $this->request->getPost('id_jenis'),
            'kode_objek' => $this->request->getPost('kode_objek'),
            'uraian_objek' => $this->request->getPost('uraian_objek'),
        ];

        $this->ObjekModel->update($id, $data);

        return redirect()->to('objek');
    }

    public function destroy($id)
    {
        $this->ObjekModel->delete($id);

        return redirect()->to('/objek');
    }
}
