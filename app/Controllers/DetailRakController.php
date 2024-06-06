<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RakBelanjaModel;
use App\Models\DetailRakBelanjaModel;


class DetailRakController extends BaseController
{
    protected $DetailRakBelanjaModel;
    protected $RakBelanjaModel;
    public function __construct()
    {
        $this->DetailRakBelanjaModel = new DetailRakBelanjaModel();
        $this->RakBelanjaModel = new RakBelanjaModel();
    }


    public function show($id)
    {
        $rakbelanja = $this->RakBelanjaModel->findDatabyId($id);
        $detailrak = $this->DetailRakBelanjaModel->where('id_rakbelanja', $id)->findAll();
        $waktu = '';

        foreach ($rakbelanja as &$rak) {
            $totalRak = $this->RakBelanjaModel->getTotalRak($rak['id']);
            $rak['total_rak'] = $totalRak;
            $waktu = $rak['waktu'];
        }

        $data = [
            'rakbelanja' => $rakbelanja,
            'detailrak' => $detailrak,
            'waktu' => $waktu // Pass the waktu variable to the view
        ];

        return view('detailrak/show', $data);
    }


    public function create($id)
    {
        // Ambil detail rak belanja berdasarkan ID rak belanja
        $detailrak = $this->DetailRakBelanjaModel->where('id_rakbelanja', $id)->findAll();
        $bulan_terpilih = array_column($detailrak, 'bulan');

        // Ambil waktu dari rak belanja
        $rakbelanja = $this->RakBelanjaModel->find($id);
        $waktu = $rakbelanja['waktu'];

        // Pemetaan waktu ke bulan
        $waktu_to_bulan = [
            'semester_1' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            'semester_2' => ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'triwulan_1' => ['Januari', 'Februari', 'Maret'],
            'triwulan_2' => ['April', 'Mei', 'Juni'],
            'triwulan_3' => ['Juli', 'Agustus', 'September'],
            'triwulan_4' => ['Oktober', 'November', 'Desember'],
            'januari' => ['Januari'],
            'februari' => ['Februari'],
            'maret' => ['Maret'],
            'april' => ['April'],
            'mei' => ['Mei'],
            'juni' => ['Juni'],
            'juli' => ['Juli'],
            'agustus' => ['Agustus'],
            'september' => ['September'],
            'oktober' => ['Oktober'],
            'november' => ['November'],
            'desember' => ['Desember']
        ];

        // Ambil bulan yang sesuai dengan waktu
        $available_bulan = $waktu_to_bulan[$waktu];

        // Buat opsi untuk dropdown bulan
        $options = '';
        foreach ($available_bulan as $bulan) {
            // Periksa apakah bulan sudah dipilih
            $disabled = in_array($bulan, $bulan_terpilih) ? 'disabled' : '';
            $options .= "<option value=\"$bulan\" $disabled>$bulan</option>";
        }

        $data = [
            'rakbelanja' => $rakbelanja,
            'detailrak' => $detailrak,
            'bulan_options' => $options
        ];

        return view('detailrak/create', $data);
    }


    public function store()
    {
        $data = [
            'bulan' => $this->request->getPost('bulan'),
            'id_rakbelanja' => $this->request->getPost('id_rakbelanja'),
            'nilai' => $this->request->getPost('nilai'),
        ];

        $this->DetailRakBelanjaModel->insert($data);

        // Ambil kembali id rak belanja dari data yang disimpan
        $id_rakbelanja = $data['id_rakbelanja'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/detailrak/show/$id_rakbelanja");
    }


    public function edit($id)
    {
        // Ambil detail rak belanja berdasarkan ID
        $detailrak = $this->DetailRakBelanjaModel->find($id);

        // Ambil ID rak belanja dari detail rak belanja
        $id_rakbelanja = $detailrak['id_rakbelanja'];

        // Ambil waktu dari rak belanja
        $rakbelanja = $this->RakBelanjaModel->find($id_rakbelanja);
        $waktu = $rakbelanja['waktu'];

        // Ambil semua bulan yang sudah terpilih untuk ID rak belanja kecuali bulan pada data yang dipilih
        $detailrak_rakbelanja = $this->DetailRakBelanjaModel
            ->where('id_rakbelanja', $id_rakbelanja)
            ->where('id !=', $id)
            ->findAll();
        $bulan_terpilih = array_column($detailrak_rakbelanja, 'bulan');

        // Pemetaan waktu ke bulan
        $waktu_to_bulan = [
            'semester_1' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            'semester_2' => ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'triwulan_1' => ['Januari', 'Februari', 'Maret'],
            'triwulan_2' => ['April', 'Mei', 'Juni'],
            'triwulan_3' => ['Juli', 'Agustus', 'September'],
            'triwulan_4' => ['Oktober', 'November', 'Desember'],
            'januari' => ['Januari'],
            'februari' => ['Februari'],
            'maret' => ['Maret'],
            'april' => ['April'],
            'mei' => ['Mei'],
            'juni' => ['Juni'],
            'juli' => ['Juli'],
            'agustus' => ['Agustus'],
            'september' => ['September'],
            'oktober' => ['Oktober'],
            'november' => ['November'],
            'desember' => ['Desember']
        ];

        // Ambil bulan yang sesuai dengan waktu
        $available_bulan = $waktu_to_bulan[$waktu];

        // Buat opsi untuk dropdown bulan
        $options = '';
        foreach ($available_bulan as $bulan) {
            // Tandai bulan yang sesuai dengan id_detail_rak sebagai selected
            $selected = ($bulan === $detailrak['bulan']) ? 'selected' : '';
            // Periksa apakah bulan sudah terpilih untuk ID rak belanja
            $disabled = in_array($bulan, $bulan_terpilih) && ($bulan !== $detailrak['bulan']) ? 'disabled' : '';
            $options .= "<option value=\"$bulan\" $disabled $selected>$bulan</option>";
        }

        $data = [
            'rakbelanja' => $rakbelanja,
            'detailrak' => $detailrak,
            'bulan_options' => $options
        ];

        return view('detailrak/edit', $data);
    }




    public function update($id)
    {
        $data = [
            'bulan' => $this->request->getPost('bulan'),
            'id_rakbelanja' => $this->request->getPost('id_rakbelanja'),
            'nilai' => $this->request->getPost('nilai'),
        ];


        $this->DetailRakBelanjaModel->update($id, $data);
        $id_rakbelanja = $data['id_rakbelanja'];

        // Redirect kembali ke fungsi show dengan menyertakan id rak belanja
        return redirect()->to("/detailrak/show/$id_rakbelanja");
    }



    public function destroy($id)
    {
        // Ambil detail rak belanja berdasarkan ID yang akan dihapus
        $detailrak = $this->DetailRakBelanjaModel->find($id);

        // Simpan id_rakbelanja sebelum melakukan delete
        $id_rakbelanja = $detailrak['id_rakbelanja'];

        // Lakukan penghapusan
        $this->DetailRakBelanjaModel->delete($id);

        // Redirect kembali ke halaman show dengan id_rakbelanja
        return redirect()->to("/detailrak/show/$id_rakbelanja");
    }



}
