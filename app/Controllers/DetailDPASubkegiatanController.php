<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
// use App\Models\DPAModel;
use App\Models\DetailDPAModel;
use App\Models\DetailDPASubkegiatanModel;
// use App\Models\SubRincianObjekModel;

class DetailDPASubkegiatanController extends BaseController
{
    protected $DetailDPAModel;
    // protected $DPAModel;
    protected $DetailDPASubkegiatanModel;
    // protected $SubRincianObjekModel;
    public function __construct()
    {
        $this->DetailDPAModel = new DetailDPAModel();
        // $this->DPAModel = new DPAModel();
        $this->DetailDPASubkegiatanModel = new DetailDPASubkegiatanModel();
        // $this->SubRincianObjekModel = new SubRincianObjekModel();
    }


    public function showdetail($id)
    {
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'detaildpa_subkegiatan' => $this->DetailDPASubkegiatanModel->where('id_detail_dpa', $id)->getDetailDPASubkegiatan($id),

        ];
        // $penatausahaans = $this->penatausahaanModel->getPenatausahaan2();
        return view('detaildpa_subkegiatan/showdetail', $data);
    }


    public function create($id)
    {
        $detaildpa_subkegiatan = $this->DetailDPASubkegiatanModel->where('id_dpa', $id)->getDetailDPASubkegiatan($id);
        // $rekening = $this->SubRincianObjekModel->getRekening();
        // $subkegiatan = $this->SubkegiatanModel->getSubkegiatan();


       
        $data = [
            // 'dpa' => $this->DPAModel->findDatabyId($id),
            'detaildpa_subkegiatan' => $detaildpa_subkegiatan,
            // 'subkegiatan' => $subkegiatan,
            // 'rekening' => $rekening,
        ];

        return view('detaildpa_subkegiatan/create', $data);
    }

    public function store()
    {
        $data = [
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'uraian' => $this->request->getPost('uraian'),
            'koefisien' => $this->request->getPost('koefisien'),
            'satuan' => $this->request->getPost('satuan'),
            'harga' => $this->request->getPost('harga'),
            'ppn' => $this->request->getPost('ppn'),
            'jumlah' => $this->request->getPost('jumlah'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tahun' => session()->get('tahun'),

            // id_detail_dpa','uraian','koefisien','satuan','harga','ppn','jumlah','keterangan',
        ];

        $this->DetailDPASubkegiatanModel->insert($data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_detail_dpa = $data['id_detail_dpa'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/detaildpa_subkegiatan/showdetail/$id_detail_dpa");
    }


    public function edit($id)
    {
        // Ambil data detail DPA berdasarkan ID
        $detaildpa_subkegiatan = $this->DetailDPASubkegiatanModel->find($id);
        $data = [
            'detaildpa_subkegiatan' => $detaildpa_subkegiatan,
            // 'subkegiatan' => $subkegiatan,
            // 'rekening' => $rekening,
        ];
    
        return view('detaildpa_subkegiatan/edit', $data);
    }
    
    public function update($id)
{
    // Ambil data dari form
    $id_detail_dpa = $this->request->getPost('id_detail_dpa'); // Ambil id_dpa dari form
    
    // Inisialisasi data yang akan diupdate
    $data = [
        'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
        'uraian' => $this->request->getPost('uraian'),
        'koefisien' => $this->request->getPost('koefisien'),
        'satuan' => $this->request->getPost('satuan'),
        'harga' => $this->request->getPost('harga'),
        'ppn' => $this->request->getPost('ppn'),
        'jumlah' => $this->request->getPost('jumlah'),
        'keterangan' => $this->request->getPost('keterangan'), // Tambahkan data jumlah_perubahan
    ];

    // Periksa apakah koefisien_perubahan tidak kosong
    if (!empty($this->request->getPost('koefisien_perubahan'))) {
        // Jika tidak kosong, tambahkan data perubahan
        $data['koefisien_perubahan'] = $this->request->getPost('koefisien_perubahan');
        $data['satuan_perubahan'] = $this->request->getPost('satuan_perubahan');
        $data['harga_perubahan'] = $this->request->getPost('harga_perubahan');
        $data['ppn_perubahan'] = $this->request->getPost('ppn_perubahan');
        $data['jumlah_perubahan'] = $this->request->getPost('jumlah_perubahan');
        $data['keterangan_perubahan'] = $this->request->getPost('keterangan_perubahan');
    }

    // Update data detail DPA berdasarkan ID
    if ($this->DetailDPASubkegiatanModel->update($id, $data)) {
        // Redirect kembali ke halaman show dengan menyertakan ID DPA jika update berhasil
        return redirect()->to("/detaildpa_subkegiatan/showdetail/$id_detail_dpa");
    } else {
        // Tambahkan logika penanganan kesalahan jika diperlukan
        return "Gagal memperbarui data.";
    }
}

    
    public function destroy($id)
    {
        // Ambil detail rak belanja berdasarkan ID yang akan dihapus
        $detaildpa_subkegiatan = $this->DetailDPASubkegiatanModel->find($id);

        // Simpan id_rakbelanja sebelum melakukan delete
        $id_detail_dpa = $detaildpa_subkegiatan['id_detail_dpa'];

        // Lakukan penghapusan
        $this->DetailDPASubkegiatanModel->delete($id);

        // Redirect kembali ke halaman show dengan id_rakbelanja
        return redirect()->to("/detaildpa_subkegiatan/showdetail/$id_detail_dpa");
    }


    public function perubahan($id)
{
    // Ambil detail rak belanja berdasarkan ID
   
    $detaildpa_subkegiatan = $this->DetailDPASubkegiatanModel->find($id);
    $data = [
        'detaildpa_subkegiatan' => $detaildpa_subkegiatan,
        // 'subkegiatan' => $subkegiatan,
        // 'rekening' => $rekening,
    ];

    return view('detaildpa_subkegiatan/perubahan', $data);
}

public function update_perubahan($id)
{
    // Validasi data yang dikirim dari formulir
    $validationRules = [
        'koefisien_perubahan' => 'required', // Sesuaikan dengan aturan validasi yang Anda butuhkan
        'satuan_perubahan' => 'required', // Sesuaikan dengan aturan validasi yang Anda butuhkan
        'harga_perubahan' => 'required|numeric', // Sesuaikan dengan aturan validasi yang Anda butuhkan
        'ppn_perubahan' => 'required|numeric', // Sesuaikan dengan aturan validasi yang Anda butuhkan
        'jumlah_perubahan' => 'required|numeric', // Sesuaikan dengan aturan validasi yang Anda butuhkan
        'keterangan_perubahan' => 'required', // Sesuaikan dengan aturan validasi yang Anda butuhkan
    ];

    if (!$this->validate($validationRules)) {
        // Jika validasi gagal, kembalikan pengguna ke halaman tambah jumlah perubahan dengan pesan kesalahan
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        // 'jumlah_perubahan_perubahan' => $this->request->getPost('jumlah_perubahan'),
        'koefisien_perubahan' => $this->request->getPost('koefisien_perubahan'),
            'satuan_perubahan' => $this->request->getPost('satuan_perubahan'),
            'harga_perubahan' => $this->request->getPost('harga_perubahan'),
            'ppn_perubahan' => $this->request->getPost('ppn_perubahan'),
            'jumlah_perubahan' => $this->request->getPost('jumlah_perubahan'),
            'keterangan_perubahan' => $this->request->getPost('keterangan_perubahan'),
    ];

    $this->DetailDPASubkegiatanModel->update($id, $data);

    // Ambil ID DPA terkait dari data yang diubah
    $detailDPASubkegiatan = $this->DetailDPASubkegiatanModel->find($id);
    $id_detail_dpa = $detailDPASubkegiatan['id_detail_dpa'];

    // Redirect kembali ke halaman show dengan menyertakan ID DPA
    return redirect()->to("/detaildpa_subkegiatan/showdetail/{$id_detail_dpa}");
}





}
