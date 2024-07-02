<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObjekModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RincianObjekModel;
class RincianObjekController extends BaseController
{
    protected $ObjekModel;
    protected $RincianObjekModel;
    public function __construct()
    {
        $this->ObjekModel = new ObjekModel();
        $this->RincianObjekModel = new RincianObjekModel();
    }

    public function index()
    {
        $data['rincianobjek'] = $this->RincianObjekModel->getData();
        return view('rincianobjek/index', $data);
    }

    public function create()
    {
        $data['objek'] = $this->ObjekModel->getData();
        return view('rincianobjek/create', $data);
    }

    public function store()
    {
        $data = [
            'id_objek' => $this->request->getPost('id_objek'),
            'kode_rincian_objek' => $this->request->getPost('kode_rincian_objek'),
            'uraian_rincian_objek' => $this->request->getPost('uraian_rincian_objek'),
            'tahun' => session()->get('tahun'),
        ];

        $this->RincianObjekModel->insert($data);

        return redirect()->to('/rincianobjek');
    }


    public function edit($id)
    {
        $data = [
            'rincianobjek' => $this->RincianObjekModel->find($id),
            'objek' => $this->ObjekModel->getData()
        ];
        return view('rincianobjek/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_objek' => $this->request->getPost('id_objek'),
            'kode_rincian_objek' => $this->request->getPost('kode_rincian_objek'),
            'uraian_rincian_objek' => $this->request->getPost('uraian_rincian_objek'),
        ];

        $this->RincianObjekModel->update($id, $data);

        return redirect()->to('rincianobjek');
    }

    public function destroy($id)
    {
        $this->RincianObjekModel->delete($id);

        return redirect()->to('/rincianobjek');
    }
}
