<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPKasTunaiModel;
use App\Models\SubkegiatanModel;
use App\Models\SubRincianObjekModel;
use App\Models\KaryawanModel;
class BPKasTunaiController extends BaseController
{
    protected $BPKasTunaiModel;
    protected $SubkegiatanModel;
    protected $SubRincianObjekModel;
    protected $KaryawanModel;
    public function __construct()
    {
        $this->BPKasTunaiModel = new BPKasTunaiModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function show()
    {
        $bp_kas_tunai = $this->BPKasTunaiModel->getBPKasTunai();


        return view('bp_kas_tunai/show', ['bp_kas_tunai' => $bp_kas_tunai]);
    }

    public function create()
    {
        $data = [
            'subkegiatan' => $this->SubkegiatanModel->getSubkegiatan(),
            'rekening' => $this->SubRincianObjekModel->getRekening(),
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
        // return view('program/create', $data);
        return view('bp_kas_tunai/create', $data);
    }

    public function store()
    {
        try {
            $data = [
                'id_subkegiatan' => $this->request->getPost('id_subkegiatan'),
                'id_sub_rincian_objek' => $this->request->getPost('id_sub_rincian_objek'),
                'tanggal' => $this->request->getPost('tanggal'),
                'no_bukti' => $this->request->getPost('no_bukti'),
                'uraian' => $this->request->getPost('uraian'),
                'penerimaan' => $this->request->getPost('penerimaan'),
                'pengeluaran' => $this->request->getPost('pengeluaran'),
                'saldo' => $this->request->getPost('saldo'),
                'jumlah_periode_ini' => $this->request->getPost('jumlah_periode_ini'),
                'jumlah_periode_lalu' => $this->request->getPost('jumlah_periode_lalu'),
                'jumlah_semua_periode' => $this->request->getPost('jumlah_semua_periode'),
                'sisa_kas' => $this->request->getPost('sisa_kas'),
                'kas_bendahara' => $this->request->getPost('kas_bendahara'),
                'kepala_dinas' => $this->request->getPost('kepala_dinas'),
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
            'subkegiatan' => $this->SubkegiatanModel->getSubkegiatan(),
            'rekening' => $this->SubRincianObjekModel->getRekening(),
            'karyawan' => $this->KaryawanModel->findAll(),        ];
        return view('bp_kas_tunai/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_subkegiatan' => $this->request->getPost('id_subkegiatan'),
            'id_sub_rincian_objek' => $this->request->getPost('id_sub_rincian_objek'),
            'tanggal' => $this->request->getPost('tanggal'),
            'no_bukti' => $this->request->getPost('no_bukti'),
            'uraian' => $this->request->getPost('uraian'),
            'penerimaan' => $this->request->getPost('penerimaan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
            'saldo' => $this->request->getPost('saldo'),
            'jumlah_periode_ini' => $this->request->getPost('jumlah_periode_ini'),
            'jumlah_periode_lalu' => $this->request->getPost('jumlah_periode_lalu'),
            'jumlah_semua_periode' => $this->request->getPost('jumlah_semua_periode'),
            'sisa_kas' => $this->request->getPost('sisa_kas'),
            'kas_bendahara' => $this->request->getPost('kas_bendahara'),
            'kepala_dinas' => $this->request->getPost('kepala_dinas'),
            'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
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
        $bp_kas_tunai = $this->BPKasTunaiModel->getBPKasTunaiById($id);
        // $id_p = $detailpenatausahaan['id_penatausahaan'];
        // $idd = $detailpenatausahaan[ 'id_detail_dpa'];

        $data = [
            'bp_kas_tunai' =>  $bp_kas_tunai,
            // 'keterangan' => $this->KeteranganModel->where('id_detail_penatausahaan', $id)->findAll(),
            // 'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            // 'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            // 'program' => $this->DetailDPAModel->getProgram($idd)
        ];

        // foreach ($data['keterangan'] as &$ket) {
        //     $total = $ket['jumlah'] * $ket['harga'];

        //     $ket['total'] = $total;
        // }
        return view('bp_kas_tunai/cetak',$data);
    }
}
