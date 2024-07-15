<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Detail2PenatausahaanModel;
use App\Models\DetailPenatausahaanModel;
use App\Models\DetailDPAModel;
use App\Models\DetailDPASubkegiatanModel;
use App\Models\SubRincianObjekModel;
use App\Models\KaryawanModel;
use App\Models\PenatausahaanModel;
use App\Models\KeteranganModel;
use App\Models\PajakModel;
use App\Models\PajakDPModel;

class DetailPenatausahaanController extends BaseController
{
    protected $PenataUsahaanModel;
    protected $DetailDPAModel;
    protected $DetailDPASubkegiatanModel;
    protected $SubRincianObjekModel;
    protected $DetailPenatausahaanModel;
    protected $Detail2PenatausahaanModel;
    protected $KaryawanModel;
    protected $KeteranganModel;
    protected $PajakModel;
    protected $PajakDPModel;

    public function __construct()
    {
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->Detail2PenatausahaanModel = new Detail2PenatausahaanModel();
        $this->DetailDPASubkegiatanModel = new DetailDPASubkegiatanModel();
        $this->DetailDPAModel = new DetailDPAModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->KaryawanModel = new KaryawanModel();
        $this->PenataUsahaanModel = new PenataUsahaanModel();
        $this->KeteranganModel = new KeteranganModel();
        $this->PajakModel = new PajakModel();
        $this->PajakDPModel = new PajakDPModel();
    }

    public function show($id)
    {
        $detailpenatausahaan = $this->DetailPenatausahaanModel->getDetail($id);

        foreach ($detailpenatausahaan as &$item) {
            $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id_detail_dpa']);
            $item['jumlahdpaperubahan'] = $this->DetailDPAModel->getTotalJumlahPerubahan($item['id_detail_dpa']);
            $item['pajak'] = $this->PajakDPModel->getpajak($item['id']);
            $item['keterangan'] = $this->KeteranganModel->getKeterangan($item['id']);
        }


        if (!empty($item['keterangan'])) {
            $sumTotal = 0;
            foreach ($item['keterangan'] as &$ket) {
                $total = $ket['jumlah'] * $ket['harga'];
                $ket['total'] = $total;
                $sumTotal += $total;
            }
        } else {
            $sumTotal = 0;
        }
       
        // Calculate nilai_pajak for each pajak item

        $data = [
            'detailpenatausahaan' => $detailpenatausahaan,
            'sumTotal' => $sumTotal
            // 'detail2' => $this->Detail2PenatausahaanModel->getAnggota($id),
        ];

        return view('detailpenatausahaan/show', $data);
    }


    public function create($id)
    {
        $detaildpa = $this->DetailDPAModel->getDPA();
        $detaildpasubkegiatan = $this->DetailDPASubkegiatanModel->getDetailDPASubkegiatan($id);
        // $rekening = $this->SubRincianObjekModel->getRekening();
        $pajak = $this->PajakModel->findAll();
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'detaildpa' => $detaildpa,
            'detaildpasubkegiatan' => $detaildpasubkegiatan,
            // 'rekening' => $rekening,
            'pajak' => $pajak
        ];

        return view('detailpenatausahaan/create', $data);
    }

    public function create2($id)
    {
        $karyawan = $this->KaryawanModel->findAll();

        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'karyawan' => $karyawan,
        ];

        return view('detailpenatausahaan/create2', $data);
    }


    public function store()
    {
        $data = [
            'id_penatausahaan' => $this->request->getPost('id_penatausahaan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'sudah_terima_dari' => $this->request->getPost('sudah_terima_dari'),
            // 'uang_sebanyak' => $this->request->getPost('uang_sebanyak'),
            'untuk_pembayaran' => $this->request->getPost('untuk_pembayaran'),
            // 'terbilang' => $this->request->getPost('terbilang'),
            'status_verifikasi' => $this->request->getPost('status_verifikasi'),
            'verifikasi_bendahara' => $this->request->getPost('verifikasi_bendahara'),
            'verifikasi_kasubbag' => $this->request->getPost('verifikasi_kasubbag'),
            'tahun' => session()->get('tahun'),
        ];

        $this->DetailPenatausahaanModel->insert($data);

        $id_detail_penatausahaan = $this->DetailPenatausahaanModel->insertID();

        if ($this->request->getPost('berisi_pajak') == 'Ya') {
            $id_pajak = $this->request->getPost('id_pajak');
            $jumlah_pajak = $this->request->getPost('jumlah_p');

            if ($id_pajak && $jumlah_pajak) {
                $pajakData = [];
                foreach ($id_pajak as $index => $pajak) {
                    $pajakData[] = [
                        'id_dp' => $id_detail_penatausahaan,
                        'id_pajak' => $pajak,
                        'jumlah_p' => $jumlah_pajak[$index]
                    ];
                }
                $this->PajakDPModel->insertBatch($pajakData);
            }
        }

        return redirect()->to("/detailpenatausahaan/show/{$data['id_penatausahaan']}");
    }


    public function store2()
    {
        $data = [
            'id_detail_penatausahaan' => $this->request->getPost('id_detail_penatausahaan'),
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'nominal' => $this->request->getPost('nominal'),
        ];

        $this->Detail2PenatausahaanModel->insert($data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_detail_penatausahaan = $data['id_detail_penatausahaan'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }

    public function edit($id)
    {
        $detaildpa = $this->DetailDPAModel->getDPA();
        $detailpenatausahaan = $this->DetailPenatausahaanModel->find($id);
        // $pajak = $this->PajakDPModel->getpajak($id);
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'detaildpa' => $detaildpa,
            'detailpenatausahaan' => $detailpenatausahaan,
            // 'pajak' => $pajak
        ];
        return view('detailpenatausahaan/edit', $data);
    }


    public function edit2($id)
    {
        $karyawan = $this->KaryawanModel->findAll();
        $detail2penatausahaan = $this->Detail2PenatausahaanModel->find($id);
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'karyawan' => $karyawan,
            'detail2' => $detail2penatausahaan
        ];

        return view('detailpenatausahaan/edit2', $data);
    }


    public function update($id)
    {
        $data = [
            'id_penatausahaan' => $this->request->getPost('id_penatausahaan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            // 'id_rekening' => $this->request->getPost('id_rekening'),
            // 'no_bk_umum' => $this->request->getPost('no_bk_umum'),
            // 'no_bk_pembantu' => $this->request->getPost('no_bk_pembantu'),
            // 'asli_123' => $this->request->getPost('asli_123'),
            // 'sudah_terima_dari' => $this->request->getPost('sudah_terima_dari'),
            // 'uang_sebanyak' => $this->request->getPost('uang_sebanyak'),
            'untuk_pembayaran' => $this->request->getPost('untuk_pembayaran'),
            // 'pajak_daerah' => $this->request->getPost('pajak_daerah'),
            // 'pph21' => $this->request->getPost('pph21'),
            // 'terbilang' => $this->request->getPost('terbilang'),
            // 'status_verifikasi' => $this->request->getPost('status_verifikasi'),
        ];

        $this->DetailPenatausahaanModel->update($id, $data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_penatausahaan = $data['id_penatausahaan'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/detailpenatausahaan/show/$id_penatausahaan");
    }


    public function update2($id)
    {
        $data = [
            'id_detail_penatausahaan' => $this->request->getPost('id_detail_penatausahaan'),
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'nominal' => $this->request->getPost('nominal'),
        ];

        $this->Detail2PenatausahaanModel->update($id, $data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_detail_penatausahaan = $data['id_detail_penatausahaan'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }




    public function destroy($id)
    {
        // Find the detail penatausahaan record
        $detailpenatausahaan = $this->DetailPenatausahaanModel->find($id);
        $id_penatausahaan = $detailpenatausahaan['id_penatausahaan'];

        // Find and delete associated tax records in PajakDPModel
        $this->PajakDPModel->where('id_dp', $id)->delete();

        // Delete the detail penatausahaan record
        $this->DetailPenatausahaanModel->delete($id);

        // Redirect back to the relevant page
        return redirect()->to("/detailpenatausahaan/show/$id_penatausahaan");
    }


    public function destroy2($id)
    {
        // Ambil detail rak belanja berdasarkan ID yang akan dihapus
        $detailpenatausahaan = $this->Detail2PenatausahaanModel->find($id);

        // Simpan id_rakbelanja sebelum melakukan delete
        $id_detail_penatausahaan = $detailpenatausahaan['id_detail_penatausahaan'];

        // Lakukan penghapusan
        $this->Detail2PenatausahaanModel->delete($id);

        // Redirect kembali ke halaman show dengan id_rakbelanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }

    public function terima($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusVerifikasi($id, 'DITERIMA');
        if ($updated) {
            // Pembaruan berhasil
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diterima']);
        } else {
            // Pembaruan gagal
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }

    public function tolak($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusVerifikasi($id, 'DITOLAK');
        if ($updated) {
            // Pembaruan berhasil
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditolak']);
        } else {
            // Pembaruan gagal
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }

    public function terima_bendahara($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusBendahara($id, 'DITERIMA');
        if ($updated) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diterima']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }

    public function tolak_bendahara($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusBendahara($id, 'DITOLAK');
        if ($updated) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditolak']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }



    public function terima_kasubbag($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusKasubbag($id, 'DITERIMA');
        if ($updated) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diterima']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }

    public function tolak_kasubbag($id)
    {
        $model = new DetailPenatausahaanModel();
        $updated = $model->updateStatusKasubbag($id, 'DITOLAK');
        if ($updated) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditolak']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
        }
    }


    public function cetak($id)
    {
        $detailpenatausahaan = $this->DetailPenatausahaanModel->getDetailById($id);
        $id_p = $detailpenatausahaan['id_penatausahaan'];
        $idd = $detailpenatausahaan['id_detail_dpa'];
        $pajak = $this->PajakDPModel->getpajak($id);
        $jumlahdpa = $this->DetailDPAModel->getTotalJumlah($idd);
        $jumlahdpaperubahan = $this->DetailDPAModel->getTotalJumlahPerubahan($idd);

        $data = [
            'detailpenatausahaan' => $detailpenatausahaan,
            'keterangan' =>  $this->KeteranganModel->getKeterangan($detailpenatausahaan['id']),
            'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            'program' => $this->DetailDPAModel->getProgram($idd),
            'pajak' => $pajak,
            'jumlahdpa' => $jumlahdpa,
            'jumlahdpaperubahan' => $jumlahdpaperubahan,
        ];

        $sumTotal = 0;
        foreach ($data['keterangan'] as &$ket) {
            $total = $ket['jumlah'] * $ket['harga'];
            $ket['total'] = $total;
            $sumTotal += $total;
        }
        // Calculate nilai_pajak for each pajak item

        $data['sumTotal'] = $sumTotal;
        unset($ket); // Unset reference to the last element
        unset($pajak_item); // Unset reference to the last element

        return view('cetak/kwitansi', $data);
    }

    public function preview($id)
    {
        $detailpenatausahaan = $this->DetailPenatausahaanModel->getDetailById($id);
        $id_p = $detailpenatausahaan['id_penatausahaan'];
        $idd = $detailpenatausahaan['id_detail_dpa'];
        $pajak = $this->PajakDPModel->getpajak($id);
        $jumlahdpa = $this->DetailDPAModel->getTotalJumlah($idd);
        $jumlahdpaperubahan = $this->DetailDPAModel->getTotalJumlahPerubahan($idd);

        $data = [
            'detailpenatausahaan' => $detailpenatausahaan,
            // 'keterangan' => $this->KeteranganModel->where('id_detail_penatausahaan', $id)->findAll(),
            'keterangan' => $this->KeteranganModel->getKeterangan($detailpenatausahaan['id']),
            'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            'program' => $this->DetailDPAModel->getProgram($idd),
            'pajak' => $pajak,
            'jumlahdpa' => $jumlahdpa,
            'jumlahdpaperubahan' => $jumlahdpaperubahan,
        ];

        foreach ($data['keterangan'] as &$ket) {
            $total = $ket['jumlah'] * $ket['harga'];
            $ket['total'] = $total;
        }
        // Calculate nilai_pajak for each pajak item

        unset($ket); // Unset reference to the last element
        unset($pajak_item); // Unset reference to the last element

        return view('cetak/preview_kwitansi', $data);
    }

    public function cetakbendahara($id)
    {
        $detailpenatausahaan = $this->DetailPenatausahaanModel->getCetakBendahara($id);
        $id_p = $detailpenatausahaan['id_penatausahaan'];
        $idd = $detailpenatausahaan['id_detail_dpa'];
        $pajak = $this->PajakDPModel->getpajak($id);
        $jumlahdpa = $this->DetailDPAModel->getTotalJumlah($idd);
        $jumlahdpaperubahan = $this->DetailDPAModel->getTotalJumlahPerubahan($idd);

        $data = [
            'detailpenatausahaan' => $detailpenatausahaan,
            'keterangan' => $this->KeteranganModel->getKeterangan($detailpenatausahaan['id']),
            'penatausahaan' => $this->PenataUsahaanModel->getPenatausahaanById($id_p),
            'nama' => $this->Detail2PenatausahaanModel->getAnggota($id),
            'kegiatan' => $this->DetailDPAModel->getKegiatan($idd),
            'program' => $this->DetailDPAModel->getProgram($idd),
            'pajak' => $pajak,
            'jumlahdpa' => $jumlahdpa,
            'jumlahdpaperubahan' => $jumlahdpaperubahan,

        ];

        foreach ($data['keterangan'] as &$ket) {
            $total = $ket['jumlah'] * $ket['harga'];
            $ket['total'] = $total;
        }
        // Calculate nilai_pajak for each pajak item

        unset($ket); // Unset reference to the last element
        unset($pajak_item); // Unset reference to the last element

        return view('cetak/pinbuk', $data);
    }
}
