<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPKasTunaiModel;
use App\Models\KaryawanModel;
class BPKasTunaiController extends BaseController
{
    protected $BPKasTunaiModel;
    protected $KaryawanModel;
    public function __construct()
    {
        $this->BPKasTunaiModel = new BPKasTunaiModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function show()
    {
        $bp_kas_tunai = $this->BPKasTunaiModel->getKaryawan();


        return view('bp_kas_tunai/show', ['bp_kas_tunai' => $bp_kas_tunai]);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
        // return view('program/create', $data);
        return view('bp_kas_tunai/create', $data);
    }

    public function store()
    {
        try {
            $data = [
                'tanggal' => $this->request->getPost('tanggal'),
                'tgl_mulai' => $this->request->getPost('tgl_mulai'),
                'tgl_selesai' => $this->request->getPost('tgl_selesai'),
                'kepala_dinas' => $this->request->getPost('kepala_dinas'),
                'jabatan_kepala_dinas' => $this->request->getPost('jabatan_kepala_dinas'),
                'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
            ];
    
            // Cek data sebelum disimpan
            print_r($data);
    
            $this->BPKasTunaiModel->insert($data);
    
            return redirect()->to('/bp_kas_tunai');
        } catch (\Exception $e) {
            // Tangkap dan cetak pesan kesalahan
            die($e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $data = [
            'bp_kas_tunai' => $this->BPKasTunaiModel->find($id),
            'karyawan' => $this->KaryawanModel->findAll(),        ];
        return view('bp_kas_tunai/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'kepala_dinas' => $this->request->getPost('kepala_dinas'),
            'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
            'tahun' => session()->get('tahun'),
        ];

        $this->BPKasTunaiModel->update($id, $data);

        return redirect()->to('bp_kas_tunai');
    }

    public function destroy($id)
    {
        $this->BPKasTunaiModel->delete($id);

        return redirect()->to('/bp_kas_tunai');
    }

    public function cetak($id)
    {
        $bp_kas_tunai = $this->BPKasTunaiModel->getCetak($id);
        $data = [
            'bp_kas_tunai' =>  $bp_kas_tunai,
        ];
        return view('bp_kas_tunai/cetak',$data);
    }
}
