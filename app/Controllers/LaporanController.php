<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LaporanModel;
use App\Models\DetailDPAModel;
use App\Models\SubkegiatanModel;
use App\Models\SubRincianObjekModel;
use App\Models\RincianObjekModel;
use App\Models\ObjekModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\AkunModel;
use App\Models\KeteranganModel;


class LaporanController extends BaseController
{
    protected $LaporanModel;
    protected $DetailDPAModel;
    protected $SubkegiatanModel;
    protected $SubRincianObjekModel;
    protected $RincianObjekModel;
    protected $ObjekModel;
    protected $JenisModel;
    protected $KelompokModel;
    protected $AkunModel;
    protected $KeteranganModel;
    public function __construct()
    {
        $this->LaporanModel = new LaporanModel();
        $this->DetailDPAModel = new DetailDPAModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->RincianObjekModel = new RincianObjekModel();
        $this->ObjekModel = new ObjekModel();
        $this->JenisModel = new JenisModel();
        $this->KelompokModel = new KelompokModel();
        $this->AkunModel = new AkunModel();
        $this->KeteranganModel = new KeteranganModel();
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

    public function getJumlahByIdDetailDpa($id_detail_dpa)
    {
        $keteranganModel = new KeteranganModel();
        $data = $keteranganModel->where('id_detail_dpa', $id_detail_dpa)->first();

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
                'tahun' => session()->get('tahun'),
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

    public function cetak1($id)
    {
        // $LaporanModel = new LaporanModel(); 
        $laporan = $this->LaporanModel->getCetak($id);
        if (!empty($laporan)) {
            foreach ($laporan as &$item) {
                $item['jumlahdpa'] = $this->LaporanModel->getTotalJumlah($item['id_detail_dpa']);
            }
        }
    
        $data = [
            'laporan' =>  $laporan,

        ];

        // foreach ($data['keterangan'] as &$ket) {
        //     $total = $ket['jumlah'] * $ket['harga'];

        //     $ket['total'] = $total;
        // }
        return view('laporan/cetak',$data);
    }

    public function cetak()
{
    $laporan = [
        'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
        'realisasi' => $this->request->getPost('realisasi'),
    ];

    $laporanData = [];
    $detail_dpa = null;
    $nama_subkegiatan = null;
    $kode_rekening = null;
    $kode_rincian_objek = null;
    $kode_objek = null;
    $kode_jenis = null;
    $kode_kelompok = null;
    $kode_akun = null;

    if (!empty($laporan['id_detail_dpa'])) {
        // Dapatkan data dari LaporanModel berdasarkan id_detail_dpa
        $laporanData = $this->LaporanModel->where('id_detail_dpa', $laporan['id_detail_dpa'])->first(); // Mengambil hanya satu data

        if ($laporanData) {
            // Tambahkan data realisasi dari inputan
            $laporanData['realisasi'] = $laporan['realisasi'];
            $laporanData['jumlahdpa'] = $this->LaporanModel->getTotalJumlah(); // Pastikan ini sesuai
        }

        // Ambil data dari DetailDPAModel
        $detail_dpa = $this->DetailDPAModel->select('tahun, id_dpa, jumlah, jumlah_perubahan, id_subkegiatan, id_rekening')
            ->where('id', $laporan['id_detail_dpa'])
            ->first();

        if ($detail_dpa) {
            $nama_subkegiatan = $this->SubkegiatanModel->select('kode_subkegiatan, nama_subkegiatan')
                ->where('id', $detail_dpa['id_subkegiatan'])
                ->first();

            $kode_rekening = $this->SubRincianObjekModel->select('uraian_sub_rincian_objek, kode_sub_rincian_objek, id_rincian_objek')
                ->where('id', $detail_dpa['id_rekening'])
                ->first();

            $kode_rincian_objek = $this->RincianObjekModel->select('uraian_rincian_objek, kode_rincian_objek, id_objek')
                ->where('id', $kode_rekening['id_rincian_objek'])
                ->first();

            $kode_objek = $this->ObjekModel->select('uraian_objek, kode_objek, id_jenis')
                ->where('id', $kode_rincian_objek['id_objek'])
                ->first();

            $kode_jenis = $this->JenisModel->select('uraian_jenis, kode_jenis, id_kelompok')
                ->where('id', $kode_objek['id_jenis'])
                ->first();

            $kode_kelompok = $this->KelompokModel->select('uraian_kelompok, kode_kelompok, id_akun')
                ->where('id', $kode_jenis['id_kelompok'])
                ->first();

            $kode_akun = $this->AkunModel->select('kode_akun')
                ->where('id', $kode_kelompok['id_akun'])
                ->first();
        }

        // Gabungkan data yang diperlukan ke dalam $laporanData
        if ($laporanData) {
            $laporanData = array_merge($laporanData, [
                'kode_akun' => $kode_akun['kode_akun'] ?? 'N/A',
                'kode_kelompok' => $kode_kelompok['kode_kelompok'] ?? 'N/A',
                'kode_jenis' => $kode_jenis['kode_jenis'] ?? 'N/A',
                'kode_objek' => $kode_objek['kode_objek'] ?? 'N/A',
                'kode_rincian_objek' => $kode_rincian_objek['kode_rincian_objek'] ?? 'N/A',
                'kode_sub_rincian_objek' => $kode_rekening['kode_sub_rincian_objek'] ?? 'N/A',
                'uraian_sub_rincian_objek' => $kode_rekening['uraian_sub_rincian_objek'] ?? 'N/A',
            ]);
        }
    }

    $data = [
        'laporan' => $laporan,
        'laporanData' => $laporanData,
        'detail_dpa' => $detail_dpa,
        'nama_subkegiatan' => $nama_subkegiatan,
        'kode_rekening' => $kode_rekening,
        'kode_rincian_objek' => $kode_rincian_objek,
        'kode_objek' => $kode_objek,
        'kode_jenis' => $kode_jenis,
        'kode_kelompok' => $kode_kelompok,
        'kode_akun' => $kode_akun,
    ];

    return view('laporan/cetak', $data);
}

    



}
