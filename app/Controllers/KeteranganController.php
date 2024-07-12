<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DetailPenatausahaanModel;
use App\Models\DetailDPASubkegiatanModel;
use App\Models\KeteranganModel;
use App\Models\Detail2PenatausahaanModel;
class KeteranganController extends BaseController
{
    protected $KeteranganModel;
    protected $DetailPenatausahaanModel;
    protected $Detail2PenatausahaanModel;
    protected $DetailDPASubkegiatanModel;
    public function __construct()
    {
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->KeteranganModel = new KeteranganModel();
        $this->Detail2PenatausahaanModel = new Detail2PenatausahaanModel();
        $this->DetailDPASubkegiatanModel = new DetailDPASubkegiatanModel();
     
    }



    public function show($id)
    {
        $data = [
            'keterangan' => $this->KeteranganModel->getKeterangan($id),
            'detailpenatausahaan' => $this->DetailPenatausahaanModel->find($id),
            'detail2' => $this->Detail2PenatausahaanModel->getAnggota($id)
        ];
        foreach ($data['keterangan'] as &$ket) {
            $total = $ket['jumlah'] * $ket['harga'];

            $ket['total'] = $total;
        }
        // $penatausahaans = $this->penatausahaanModel->getPenatausahaan2();
        return view('keterangan/show', $data);
    }


    public function create($id)
    {
        $data = [
           
            'detailpenatausahaan' => $this->DetailPenatausahaanModel->find($id),
            'detaildpasubkegiatan' => $this->DetailDPASubkegiatanModel->getKeterangan()
        ];
        return view('keterangan/create', $data);
    }

    public function store()
    {
        $data = [
            'id_detail_penatausahaan' => $this->request->getPost('id_detail_penatausahaan'),
            'id_dpa_subkegiatan' => $this->request->getPost('id_dpa_subkegiatan'),
            'id_dpa_subkegiatan' => $this->request->getPost('id_dpa_subkegiatan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tahun' => session()->get('tahun'),
        ];

        $this->KeteranganModel->insert($data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_detail_penatausahaan = $data['id_detail_penatausahaan'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }


    public function edit($id)
    {
        $data = [
            'keterangan' => $this->KeteranganModel->find($id),
           'detaildpasubkegiatan' => $this->DetailDPASubkegiatanModel->getKeterangan()
          
        ];

        return view('keterangan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_detail_penatausahaan' => $this->request->getPost('id_detail_penatausahaan'),
            'id_dpa_subkegiatan' => $this->request->getPost('id_dpa_subkegiatan'),
            'id_dpa_subkegiatan' => $this->request->getPost('id_dpa_subkegiatan'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $this->KeteranganModel->update($id, $data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_detail_penatausahaan = $data['id_detail_penatausahaan'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }

    public function destroy($id)
    {
        // Ambil detail rak belanja berdasarkan ID yang akan dihapus
        $data = $this->KeteranganModel->find($id);

        // Simpan id_rakbelanja sebelum melakukan delete
        $id_detail_penatausahaan = $data['id_detail_penatausahaan'];

        // Lakukan penghapusan
        $this->KeteranganModel->delete($id);

        // Redirect kembali ke halaman show dengan id_rakbelanja
        return redirect()->to("/keterangan/show/$id_detail_penatausahaan");
    }


}
