<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BPSimpananBankModel;
use App\Models\KaryawanModel;
use App\Models\PenatausahaanModel;
use App\Models\DetailPenatausahaanModel;
use App\Models\PajakDPModel;
use App\Models\DetailDPAModel;
use App\Models\SubRincianObjekModel;

class BPSimpananBankController extends BaseController
{
    protected $BPSimpananBankModel;
    protected $KaryawanModel;
    protected $PenatausahaanModel;
    protected $PajakModel;
    protected $DetailPenatausahaanModel;
    protected $PajakDPModel;
    protected $DetailDPAModel;
    protected $SubRincianObjekModel;
    public function __construct()
    {
        $this->BPSimpananBankModel = new BPSimpananBankModel();
        $this->KaryawanModel = new KaryawanModel();
        $this->PenatausahaanModel = new PenatausahaanModel();
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->PajakDPModel = new PajakDPModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->DetailDPAModel = new DetailDPAModel();
    }

    public function show()
    {
        $bp_simpanan_bank = $this->BPSimpananBankModel->getKaryawan();


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
                'tahun' => session()->get('tahun'),
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
            'karyawan' => $this->KaryawanModel->findAll(),
        ];
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
        $bp_simpanan_bank  = [
            'tanggal' => $this->request->getPost('tanggal'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'kepala_dinas' => $this->request->getPost('kepala_dinas'),
            'bendahara_pengeluaran' => $this->request->getPost('bendahara_pengeluaran'),
            'tahun' => session()->get('tahun'),
        ];
        $kepala_dinas = $this->KaryawanModel->select('nama,nip,jabatan,file')->where('nip', $bp_simpanan_bank['kepala_dinas'])->first();
        $bendahara_pengeluaran = $this->KaryawanModel->select('nama,nip,jabatan,file')->where('nip', $bp_simpanan_bank['bendahara_pengeluaran'])->first();

        // $penatausahaan = $this->PenatausahaanModel->where('YEAR(tanggal)', session()->get('tahun'))->orderBy('tanggal', 'asc')->findAll();
        $penatausahaan = $this->PenatausahaanModel
        ->where('tanggal >=', $bp_simpanan_bank['tgl_mulai'])
        ->where('tanggal <=', $bp_simpanan_bank['tgl_selesai'])
        ->orderBy('tanggal', 'asc')
            ->findAll();
        $tgl_awal = $this->PenatausahaanModel->where('YEAR(tanggal)', session()->get('tahun'))->orderBy('tanggal', 'asc')->first()['tanggal'] ?? 'Tidak ada data';
        $jumlahdpaArray = [];
        $saldo_awal = 0;
        $data = [];

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
                    ->join('detail_dpa as dd2', 'dd2.id = detail_penatausahaan.id_detail_dpa')
                    ->join('subkegiatan', 'subkegiatan.id = dd2.id_subkegiatan')
                    ->first();

                $kode_rekening = $this->DetailPenatausahaanModel
                    ->getRekening($detail['id']);

                $jumlahdpa = $this->DetailDPAModel->getTotalJumlah($detail['id_detail_dpa']);
                $jumlahdpaArray[] = $jumlahdpa;
                $saldo_awal += $jumlahdpa;

                if ($detail['verifikasi_kasubbag'] == 'DITERIMA') {
                    $data[] = [
                        'type' => 'detail',
                        'tanggal' => $p['tanggal'],
                        'no_bukti' => $detail['id'] . '/DISP/' . $kode_bidang['kode_bidang'] . '/' . session()->get('tahun'),
                        'uraian' => $uraian['uraian_sub_rincian_objek'],
                        'kode_rekening' => $kode_rekening['kode_rekening'],
                        'pemotongan' => $pajak_dp ? $pajak_dp[0]['jumlah_p'] : 0,
                        'penyetoran' => '',
                        'saldo' => $jumlahdpa,
                    ];

                    foreach ($pajak_dp as $pajak) {
                        $data[] = [
                            'type' => 'pajak',
                            'tanggal' => '',
                            'no_bukti' => $pajak['id'] . '/DISP/PJK/' . session()->get('tahun'),
                            'uraian' => 'Penerimaan FPK' . ' - ' . $pajak['nama_pajak'],
                            'pengeluaran' => $pajak['jumlah_p'],
                            'penerimaan' => $pajak['jumlah_p'],
                            'saldo' => '',
                        ];
                    }
                }
            }
        }

        $viewData = [
            'bp_simpanan_bank' =>  $bp_simpanan_bank,
            'data' => $data,
            'kepala_dinas' => $kepala_dinas,
            'bendahara_pengeluaran' => $bendahara_pengeluaran,
            'tgl_awal' => $tgl_awal,
            'saldo_awal' => $saldo_awal
        ];

        return view('bp_simpanan_bank/cetak', $viewData);
    }
}
