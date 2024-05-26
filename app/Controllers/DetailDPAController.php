<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DPAModel;
use App\Models\DetailDPAModel;
use App\Models\SubkegiatanModel;
use App\Models\SubRincianObjekModel;

class DetailDPAController extends BaseController
{
    protected $DetailDPAModel;
    protected $DPAModel;
    protected $SubkegiatanModel;
    protected $SubRincianObjekModel;
    public function __construct()
    {
        $this->DetailDPAModel = new DetailDPAModel();
        $this->DPAModel = new DPAModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
        $this->SubRincianObjekModel = new SubRincianObjekModel();
    }


    public function show($id)
{
    $data = [
        'detaildpa' => $this->DetailDPAModel->getDetailDPA($id), // Mengirimkan ID
    ];
    
    if (!empty($data['detaildpa'])) {
        foreach ($data['detaildpa'] as &$item) {
            $item['jumlahdpa'] = $this->DetailDPAModel->getTotalJumlah($item['id']);
            $item['jumlahdpaperubahan'] = $this->DetailDPAModel->getTotalJumlahPerubahan($item['id']);
        }
    }

    return view('detaildpa/show', $data);
}



public function show1($id)
    {
        $data['detaildpa'] = $this->DetailDPAModel->getDetailDPA($id);
        foreach ($data['detaildpa'] as &$rak) {
            $totalRak = $this->DetailDPAModel->getTotalJumlah($rak['id']);
            $rak['total_rak'] = $totalRak;
        }
        return view('detaildpa/show', $data);
    }



    public function create($id)
    {
        $detaildpa = $this->DetailDPAModel->where('id_dpa', $id)->findAll();
        $rekening = $this->SubRincianObjekModel->getRekening();
        $subkegiatan = $this->SubkegiatanModel->getSubkegiatan();


       
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'detaildpa' => $detaildpa,
            'subkegiatan' => $subkegiatan,
            'rekening' => $rekening,
        ];

        return view('detaildpa/create', $data);
    }

    public function store()
    {
        $data = [
            'id_dpa' => $this->request->getPost('id_dpa'),
            'id_subkegiatan' => $this->request->getPost('id_subkegiatan'),
            'id_rekening' => $this->request->getPost('id_rekening'),
            // 'jumlah' => $this->request->getPost('jumlah'),
        ];

        $this->DetailDPAModel->insert($data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_dpa = $data['id_dpa'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/detaildpa/show/$id_dpa");
    }


    public function edit($id)
    {
        // Ambil data detail DPA berdasarkan ID
        $detaildpa = $this->DetailDPAModel->find($id);
        // Ambil data rekening dan subkegiatan untuk dropdown
        $rekening = $this->SubRincianObjekModel->getRekening();
        $subkegiatan = $this->SubkegiatanModel->getSubkegiatan();
    
        // Kirim data ke view
        $data = [
            'detaildpa' => $detaildpa,
            'subkegiatan' => $subkegiatan,
            'rekening' => $rekening,
        ];
    
        return view('detaildpa/edit', $data);
    }
    
    public function update($id)
    {
        // Ambil data dari form
        $id_dpa = $this->request->getPost('id_dpa'); // Ambil id_dpa dari form
        $data = [
            'id_subkegiatan' => $this->request->getPost('id_subkegiatan'),
            'id_rekening' => $this->request->getPost('id_rekening'),
            // 'jumlah' => $this->request->getPost('jumlah'),
            // 'jumlah_perubahan' => $this->request->getPost('jumlah_perubahan'), // Tambahkan data jumlah_perubahan
        ];
    
        // Update data detail DPA berdasarkan ID
        if ($this->DetailDPAModel->update($id, $data)) {
            // Redirect kembali ke halaman show dengan menyertakan ID DPA jika update berhasil
            return redirect()->to("/detaildpa/show/$id_dpa");
        } else {
            // Tambahkan logika penanganan kesalahan jika diperlukan
            return "Gagal memperbarui data.";
        }
    }

    public function destroy($id)
    {
        // Ambil detail rak belanja berdasarkan ID yang akan dihapus
        $detaildpa = $this->DetailDPAModel->find($id);

        // Simpan id_rakbelanja sebelum melakukan delete
        $id_dpa = $detaildpa['id_dpa'];

        // Lakukan penghapusan
        $this->DetailDPAModel->delete($id);

        // Redirect kembali ke halaman show dengan id_rakbelanja
        return redirect()->to("/detaildpa/show/$id_dpa");
    }

}
