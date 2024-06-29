<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPPajakModel;
use App\Models\KaryawanModel;
class BPPajakController extends BaseController
{
    protected $BPPajakModel;
    protected $KaryawanModel;
    public function __construct()
    {
        $this->BPPajakModel = new BPPajakModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function show()
    {
        $bp_pajak = $this->BPPajakModel->getKaryawan();


        return view('bp_pajak/show', ['bp_pajak' => $bp_pajak]);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
        // return view('program/create', $data);
        return view('bp_pajak/create', $data);
    }

    public function store()
    {
        try {
            $data = [
                'tanggal' => $this->request->getPost('tanggal'),
                'tgl_mulai' => $this->request->getPost('tgl_mulai'),
                'tgl_selesai' => $this->request->getPost('tgl_selesai'),
                'kepala_dinas' => $this->request->getPost('kepala_dinas'),
                'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
            ];
    
            // Cek data sebelum disimpan
            print_r($data);
    
            $this->BPPajakModel->insert($data);
    
            return redirect()->to('/bp_pajak');
        } catch (\Exception $e) {
            // Tangkap dan cetak pesan kesalahan
            die($e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $data = [
            'bp_pajak' => $this->BPPajakModel->find($id),
            'karyawan' => $this->KaryawanModel->findAll(),        ];
        return view('bp_pajak/edit', $data);
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

        $this->BPPajakModel->update($id, $data);

        return redirect()->to('bp_pajak');
    }

    public function destroy($id)
    {
        $this->BPPajakModel->delete($id);

        return redirect()->to('/bp_pajak');
    }

    public function cetak($id)
    {
        $bp_pajak = $this->BPPajakModel->getBPPajakById($id);
        // $id_p = $detailpenatausahaan['id_penatausahaan'];
        // $idd = $detailpenatausahaan[ 'id_detail_dpa'];

        $data = [
            'bp_pajak' =>  $bp_pajak,
            // 'keterangan' => $this->KeteranganModel->where('id_detail_penatausahaan', $id)->findAll(),
            // 'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            // 'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            // 'program' => $this->DetailDPAModel->getProgram($idd)
        ];

        // foreach ($data['keterangan'] as &$ket) {
        //     $total = $ket['jumlah'] * $ket['harga'];

        //     $ket['total'] = $total;
        // }
        return view('bp_pajak/cetak',$data);
    }
}
