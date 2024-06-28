<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenatausahaanModel;
use App\Models\DetailPenatausahaanModel;
use App\Models\SubkegiatanModel;
use App\Models\SubRincianObjekModel;
use App\Models\DetailDPAModel;
use App\Models\PajakDPModel;
use App\Models\PajakModel;
use CodeIgniter\HTTP\Files\UploadedFile;
class VerifikasiController extends BaseController
{
    protected $PenatausahaanModel;
    protected $DetailPenatausahaanModel;
    protected $SubkegiatanModel;
    protected $SubRincianObjekModel;
    protected $PajakDPModel;
    protected $PajakModel;
    protected $DetailDPAModel;

    public function __construct()
    {
        $this->PenatausahaanModel = new PenatausahaanModel();
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->DetailDPAModel = new DetailDPAModel();
        $this->PajakDPModel = new PajakDPModel();
        $this->PajakModel = new PajakModel();
    }

    // public function index()
    // {
    //     $PenatausahaanModel = new PenatausahaanModel();
    //     $verifikasi = $PenatausahaanModel->joinDetailPenatausahaan()->findAll();
    //     $lastQuery = $PenatausahaanModel->getLastQuery();
    //     // echo $lastQuery;
        

    //     return view('verifikasi/index', ['verifikasi' => $verifikasi]);
    // }

    public function index()
{
    $penatausahaan = $this->DetailPenatausahaanModel->getVerifikasi();

    if (!empty($penatausahaan)) {
        foreach ($penatausahaan as &$item) {
            $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id_detail_dpa']);
            $item['jumlahdpaperubahan'] = $this->DetailDPAModel->getTotalJumlahPerubahan($item['id_detail_dpa']);
            $item['pajak'] = $this->PajakDPModel->getPajakByIdDp($item['id']);
        }
    }

    $data = [
        'penatausahaan' => $penatausahaan
    ];

    return view('verifikasi/index', $data);
}
    public function index_bendahara()
{
    $penatausahaan = $this->DetailPenatausahaanModel->getVerifikasiBendahara();

    if (!empty($penatausahaan)) {
        foreach ($penatausahaan as &$item) {
            $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id']);
            $item['jumlahdpaperubahan'] = $this->DetailDPAModel->getTotalJumlahPerubahan($item['id']);
            $item['pajak'] = $this->PajakDPModel->getPajakByIdDp($item['id']);
        }
    }

    $data = [
        'penatausahaan' => $penatausahaan
    ];

    return view('verifikasi/index_bendahara', $data);
}

    public function index_kasubbag()
{
    $penatausahaan = $this->DetailPenatausahaanModel->getVerifikasiKasubbag();

    if (!empty($penatausahaan)) {
        foreach ($penatausahaan as &$item) {
            $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id']);
            $item['jumlahdpaperubahan'] = $this->DetailDPAModel->getTotalJumlahPerubahan($item['id']);
            $item['pajak'] = $this->PajakDPModel->getPajakByIdDp($item['id']);
        }
    }

    $data = [
        'penatausahaan' => $penatausahaan
    ];

    return view('verifikasi/index_kasubbag', $data);
}


   
    // public function destroy($id)
    // {
    //     $this->PenatausahaanModel->delete($id);

    //     return redirect()->to('/verifikasi');
    // }

//     public function preview_spj($filename)
// {
//         $data['filename'] = $filename;
//     return view('verifikasi/preview_spj', $data);
// }

//     public function preview_kwintansi($filename)
//     {
//         $data['filename'] = $filename;
//         return view('verifikasi/preview_kwintansi', $data);
//     }


// public function download($id)
// {
//     $data = $this->PenatausahaanModel->find($id);
//     return $this->response->download(ROOTPATH . 'public/uploads/spj/' . $data['file_spj'], null);
// }

   
public function terima_bendahara($id)
{
    $model = new DetailPenatausahaanModel();
    $updated = $model->updateStatusBendahara($id, 'DITERIMA');
    if ($updated) {
        // Pembaruan berhasil
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diterima']);
    } else {
        // Pembaruan gagal
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
    }
}

public function tolak_bendahara($id)
{
    $model = new DetailPenatausahaanModel();
    $updated = $model->updateStatusBendahara($id, 'DITOLAK');
    if ($updated) {
        // Pembaruan berhasil
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditolak']);
    } else {
        // Pembaruan gagal
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
    }
}

public function terima_kasubbag($id)
{
    $model = new DetailPenatausahaanModel();
    $updated = $model->updateStatusKasubbag($id, 'DITERIMA');
    if ($updated) {
        // Pembaruan berhasil
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diterima']);
    } else {
        // Pembaruan gagal
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
    }
}

public function tolak_kasubbag($id)
{
    $model = new DetailPenatausahaanModel();
    $updated = $model->updateStatusKasubbag($id, 'DITOLAK');
    if ($updated) {
        // Pembaruan berhasil
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil ditolak']);
    } else {
        // Pembaruan gagal
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui status.']);
    }
}
}