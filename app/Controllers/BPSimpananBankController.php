<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPSimpananBankModel;
use App\Models\KaryawanModel;
class BPSimpananBankController extends BaseController
{
    protected $BPSimpananBankModel;
    protected $KaryawanModel;
    public function __construct()
    {
        $this->BPSimpananBankModel = new BPSimpananBankModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function show()
    {
        $bp_simpanan_bank = $this->BPSimpananBankModel->findAll();


        return view('bp_simpanan_bank/show', ['bp_simpanan_bank' => $bp_simpanan_bank]);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
        // return view('program/create', $data);
        return view('bp_simpanan_bank/create', $data);
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
    
            $this->BPSimpananBankModel->insert($data);
    
            return redirect()->to('/bp_simpanan_bank');
        } catch (\Exception $e) {
            // Tangkap dan cetak pesan kesalahan
            die($e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $data = [
            'bp_simpanan_bank' => $this->BPSimpananBankModel->find($id),
            'karyawan' => $this->KaryawanModel->findAll(),        ];
        return view('bp_simpanan_bank/edit', $data);
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

        $this->BPSimpananBankModel->update($id, $data);

        return redirect()->to('bp_simpanan_bank');
    }

    public function destroy($id)
    {
        $this->BPSimpananBankModel->delete($id);

        return redirect()->to('/bp_simpanan_bank');
    }

    public function cetak($id)
    {
        $bp_simpanan_bank = $this->BPSimpananBankModel->getBPPajakById($id);
        // $id_p = $detailpenatausahaan['id_penatausahaan'];
        // $idd = $detailpenatausahaan[ 'id_detail_dpa'];

        $data = [
            'bp_simpanan_bank' =>  $bp_simpanan_bank,
            // 'keterangan' => $this->KeteranganModel->where('id_detail_penatausahaan', $id)->findAll(),
            // 'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            // 'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            // 'program' => $this->DetailDPAModel->getProgram($idd)
        ];

        // foreach ($data['keterangan'] as &$ket) {
        //     $total = $ket['jumlah'] * $ket['harga'];

        //     $ket['total'] = $total;
        // }
        return view('bp_simpanan_bank/cetak',$data);
    }
}
