<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LaporanModel;
use App\Models\DetailDPAModel;
class LaporanController extends BaseController
{
    protected $LaporanModel;
    protected $DetailDPAModel;
    public function __construct()
    {
        $this->LaporanModel = new LaporanModel();
        $this->DetailDPAModel = new DetailDPAModel();
    }

    public function index()
    {
        $laporan = $this->LaporanModel->getRekening();

        if (!empty($laporan)) {
            foreach ($laporan as &$item) {
                $item['jumlahdpa'] = $this->LaporanModel->getTotalJumlah($item['id_detail_dpa']);
            }
        }
        return view('laporan/index', ['laporan' => $laporan]);
    }

    public function create()
    {
        $data = [
            'subkegiatan' => $this->DetailDPAModel->getRekening(),
        ];
        if (!empty($data['subkegiatan'])) {
            foreach ($data['subkegiatan'] as &$item) {
                $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id']);
            }
        }
        // return view('program/create', $data);
        return view('laporan/create', $data);
    }

    public function store()
    {
            $data = [
                'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
                'realisasi' => $this->request->getPost('realisasi'),
            ];
    
            // Cek data sebelum disimpan
            print_r($data);
    
            $this->LaporanModel->insert($data);
    
            return redirect()->to('/laporan');
        
    }
    

    public function edit($id)
    {
        $data = [
            'laporan' => $this->LaporanModel->find($id),
            'subkegiatan' => $this->DetailDPAModel->getRekening()];
            if (!empty($data['subkegiatan'])) {
                foreach ($data['subkegiatan'] as &$item) {
                    $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id']);
                }
            }
        return view('laporan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'kepala_dinas' => $this->request->getPost('kepala_dinas'),
            'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
        ];

        $this->LaporanModel->update($id, $data);

        return redirect()->to('bp_kas_tunai');
    }

    public function destroy($id)
    {
        $this->LaporanModel->delete($id);

        return redirect()->to('/laporan');
    }

    public function cetak($id)
    {
        // $LaporanModel = new LaporanModel(); 
        $laporan = $this->LaporanModel->getCetak($id);
    
        $data = [
            'laporan' =>  $laporan,

        ];

        // foreach ($data['keterangan'] as &$ket) {
        //     $total = $ket['jumlah'] * $ket['harga'];

        //     $ket['total'] = $total;
        // }
        return view('laporan/cetak',$data);
    }
}
