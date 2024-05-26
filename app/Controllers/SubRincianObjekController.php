<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RincianObjekModel;
use App\Models\SubRincianObjekModel;
use App\Models\AkunModel;
use App\Models\KelompokModel;
use App\Models\JenisModel;
use App\Models\ObjekModel;
class SubRincianObjekController extends BaseController
{
    protected $AkunModel;
    protected $KelompokModel;
    protected $SubRincianObjekModel;
    protected $RincianObjekModel;
    protected $JenisModel;
    protected $ObjekModel;
    public function __construct()
    {
        $this->AkunModel = new AkunModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->RincianObjekModel = new RincianObjekModel();
        $this->KelompokModel = new KelompokModel();
        $this->JenisModel = new JenisModel();
        $this->ObjekModel = new ObjekModel();
    }

    public function index()
    {
        $data['subrincian'] = $this->SubRincianObjekModel->getRekening();
        return view('subrincian/index', $data);
    }

    public function create()
    {
        $data = [
            'rincian_objek' => $this->RincianObjekModel->findAll(),
        ];
        return view('subrincian/create', $data);
    }

    public function store()
    {
        $data = [
            'id_akun' => $this->request->getPost('id_akun'),
            'id_kelompok' => $this->request->getPost('id_kelompok'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'id_objek' => $this->request->getPost('id_objek'),
            'id_rincian_objek' => $this->request->getPost('id_rincian_objek'),
            'kode_sub_rincian_objek' => $this->request->getPost('kode_sub_rincian_objek'),
            'uraian_sub_rincian_objek' => $this->request->getPost('uraian_sub_rincian_objek'),
        ];

        $this->SubRincianObjekModel->insert($data);

        return redirect()->to('/subrincian');
    }


    public function edit($id)
    {
        $data = [
            'subrincian' => $this->SubRincianObjekModel->find($id),
            'rincianobjek' => $this->RincianObjekModel->findAll(),
            // 'objek' => $this->ObjekModel->findAll(),
            // 'jenis' => $this->JenisModel->findAll(),
            // 'kelompok' => $this->KelompokModel->findAll(),
            // 'akun' => $this->AkunModel->findAll(),
        ];
        return view('subrincian/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_rincian_objek' => $this->request->getPost('id_rincian_objek'),
            'kode_sub_rincian_objek' => $this->request->getPost('kode_sub_rincian_objek'),
            'uraian_sub_rincian_objek' => $this->request->getPost('uraian_sub_rincian_objek'),
        ];

        $this->SubRincianObjekModel->update($id, $data);

        return redirect()->to('subrincian');
    }

    public function destroy($id)
    {
        $this->SubRincianObjekModel->delete($id);

        return redirect()->to('/subrincian');
    }


    // AJAX METHOD FOR DEPENDENT DROPDOWN / CHAINED SELECT OPTION
    public function getKelompok($id)
    {
        $data = $this->KelompokModel->where('id_akun', $id)->findAll();
        return json_encode($data);
    }

    public function getJenis($id)
    {
        $data = $this->JenisModel->where('id_kelompok', $id)->findAll();
        return json_encode($data);
    }

    public function getObjek($id)
    {
        $data = $this->ObjekModel->where('id_jenis', $id)->findAll();
        return json_encode($data);
    }

    public function getRincianObjek($id)
    {
        $data = $this->RincianObjekModel->where('id_objek', $id)->findAll();
        return json_encode($data);
    }
}
