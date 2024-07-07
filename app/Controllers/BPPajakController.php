<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPPajakModel;
use App\Models\KaryawanModel;
use App\Models\PenatausahaanModel;
use App\Models\DetailPenatausahaanModel;
use App\Models\PajakDPModel;
use App\Models\DetailDPAModel;
use App\Models\SubRincianObjekModel;

class BPPajakController extends BaseController
{
    protected $BPPajakModel;
    protected $KaryawanModel;
    protected $PenatausahaanModel;
    protected $PajakModel;
    protected $DetailPenatausahaanModel;
    protected $PajakDPModel;
    protected $DetailDPAModel;
    protected $SubRincianObjekModel;
    public function __construct()
    {
        $this->BPPajakModel = new BPPajakModel();
        $this->KaryawanModel = new KaryawanModel();
        $this->PenatausahaanModel = new PenatausahaanModel();
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->PajakDPModel = new PajakDPModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->DetailDPAModel = new DetailDPAModel();
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
                'tahun' => session()->get('tahun'),
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
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
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


    public function cetak()
    {
         
        $bp_pajak = [
            'tanggal' => $this->request->getPost('tanggal'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'kepala_dinas' => $this->request->getPost('kepala_dinas'),
            'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
            'tahun' => session()->get('tahun')
        ];

        $penatausahaan = $this->PenatausahaanModel->where('YEAR(tanggal)', session()->get('tahun'))->findAll();
        $data = [];

        $kepala_dinas = $this->KaryawanModel->select('nama,nip,jabatan,file')->where('nip',$bp_pajak['kepala_dinas'])->first();
        $bendahara_pengeluaran = $this->KaryawanModel->select('nama,nip,jabatan,file')->where('nip', $bp_pajak['bendahara_pengeluaran'])->first();

        foreach ($penatausahaan as $p) {
            $detailpenatausahaan = $this->DetailPenatausahaanModel
                ->where('id_penatausahaan', $p['id'])
                ->where('status_verifikasi', 'DITERIMA')
                ->findAll();

            foreach ($detailpenatausahaan as $detail) {
                $uraian = $this->SubRincianObjekModel
                    ->select('uraian_sub_rincian_objek')
                    ->join('detail_dpa as dd1', 'sub_rincian_objek.id = dd1.id_rekening')
                    ->where('dd1.id', $detail['id_detail_dpa'])
                    ->first();

                $pajak_dp = $this->PajakDPModel
                    ->select('pajak_dp.id, pajak_dp.jumlah_p, pajak.nama_pajak')
                    ->join('pajak', 'pajak_dp.id_pajak = pajak.id')
                    ->where('pajak_dp.id_dp', $detail['id'])
                    ->where('pajak.jenis_pajak', 'Negara')
                    ->findAll();

                $kode_bidang = $this->DetailPenatausahaanModel
                    ->select('subkegiatan.kode_bidang')
                    ->join('detail_dpa as dd2','dd2.id = detail_penatausahaan.id_detail_dpa')
                    ->join('subkegiatan', 'subkegiatan.id = dd2.id_subkegiatan')
                    ->first();

                $jumlahdpa = $this->DetailDPAModel->getTotalJumlah($detail['id_detail_dpa']);

                if($pajak_dp){
                    $data[] = [
                        'type' => 'detail',
                        'tanggal' => $p['tanggal'],
                        'no_bukti' => $detail['id'] . '/DISP/' . $kode_bidang['kode_bidang'] . '/' . session()->get('tahun'),
                        'uraian' => $uraian['uraian_sub_rincian_objek'],
                        'pemotongan' => $pajak_dp ? $pajak_dp[0]['jumlah_p'] : 0,
                        'penyetoran' => '',
                        'saldo' => $jumlahdpa,
                    ];

                    foreach ($pajak_dp as $pajak) {
                        $data[] = [
                            'type' => 'pajak',
                            'tanggal' => '',
                            'no_bukti' => $pajak['id'] . '/DISP/PJK/' . session()->get('tahun'),
                            'uraian' => $pajak['nama_pajak'] . ' ' . $uraian['uraian_sub_rincian_objek'],
                            'pemotongan' => '',
                            'penyetoran' => $pajak['jumlah_p'],
                            'saldo' => '',
                        ];
                    }
                }
                
            }
        }

        $viewData = [
            'bp_pajak' => $bp_pajak,
            'kepala_dinas' => $kepala_dinas,
            'bendahara_pengeluaran' => $bendahara_pengeluaran,
            'data' => $data
        ];

        return view('bp_pajak/cetak', $viewData);
    }


}
