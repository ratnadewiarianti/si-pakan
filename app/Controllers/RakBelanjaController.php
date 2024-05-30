<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SubRincianObjekModel;
use App\Models\DetailDPAModel;
use App\Models\RakBelanjaModel;
class RakBelanjaController extends BaseController
{
    protected $SubRincianObjekModel;
    protected $RakBelanjaModel;
    protected $DetailDPAModel;
    public function __construct()
    {
        $this->SubRincianObjekModel = new SubRincianObjekModel();
        $this->RakBelanjaModel = new RakBelanjaModel();
        $this->DetailDPAModel = new DetailDPAModel();
    }

    public function cekwaktu()
    {
        return view('rakbelanja/cekwaktu');
    }

    public function index($waktu)
    {
        $data['rakbelanja'] = $this->RakBelanjaModel->findDatabyTime($waktu);
        foreach ($data['rakbelanja'] as &$rak) {
            $totalRak = $this->RakBelanjaModel->getTotalRak($rak['id']);
            $rak['total_rak'] = $totalRak;
        }
        return view('rakbelanja/index', $data);
    }


    public function create($waktu)
    {
        $data['rekening'] = $this->DetailDPAModel->getRekening();
        // $data['rekening'] = $this->SubRincianObjekModel->getRekening();
        return view('rakbelanja/create', $data);
    }

    public function getTotalJumlah($id)
    {
        try {
            $totalJumlah = $this->DetailDPAModel->getTotalJumlah($id);
            $jumlahRak = $this->RakBelanjaModel->where('id_detail_dpa', $id)->countAllResults();
            $totalNilaiRincian = 0;
            if ($jumlahRak > 0) {
                $totalNilaiRincian = $this->RakBelanjaModel->where('id_detail_dpa', $id)->selectSum('nilai_rincian')->get()->getRow()->nilai_rincian;
                $hasil = $totalJumlah - $totalNilaiRincian;
            }else{
                $hasil = $totalJumlah;
            }
            return $this->response->setJSON(['total_jumlah' => $hasil]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Terjadi kesalahan pada server.']);
        }
    }

    public function cekNilai($idDetailDPA, $nilaiRincian)
    {
        try {
            $totalJumlah = $this->DetailDPAModel->getTotalJumlah($idDetailDPA);
            $jumlahRak = $this->RakBelanjaModel->where('id_detail_dpa', $idDetailDPA)->countAllResults();
            $totalNilaiRincian = 0;

            if ($jumlahRak > 0) {
                $totalNilaiRincian = $this->RakBelanjaModel->where('id_detail_dpa', $idDetailDPA)->selectSum('nilai_rincian')->get()->getRow()->nilai_rincian;
                $hasil = $totalJumlah - $totalNilaiRincian;

                if ($nilaiRincian > $hasil) {
                    return $this->response->setJSON(['error' => 'Nilai rincian melebihi jumlah maksimal.']);
                }
            } else {
                if ($nilaiRincian > $totalJumlah) {
                    return $this->response->setJSON(['error' => 'Nilai rincian melebihi jumlah maksimal.']);
                }
            }

            return $this->response->setJSON(['success' => 'Nilai rincian valid.']);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Terjadi kesalahan pada server.']);
        }
    }

    public function store()
    {
        
        $data = [
            // 'nm_subkegiatan' => $this->request->getPost('nm_subkegiatan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'nilai_rincian' => $this->request->getPost('nilai_rincian'),
            'waktu' => $this->request->getPost('waktu')
        ];
        $waktu = $data['waktu'];


        $this->RakBelanjaModel->insert($data);

        return redirect()->to("/rakbelanja/index/$waktu");
     }


    public function edit($id)
    {
        $data = [
            'rakbelanja' => $this->RakBelanjaModel->find($id),
            'rekening' => $this->DetailDPAModel->getRekening()
        ];
        return view('rakbelanja/edit', $data);
    }

    public function update($id)
    {
        $data = [
            // 'nm_subkegiatan' => $this->request->getPost('nm_subkegiatan'),
            'id_detail_dpa' => $this->request->getPost('id_detail_dpa'),
            'nilai_rincian' => $this->request->getPost('nilai_rincian'),
            'waktu' => $this->request->getPost('waktu'),
        ];

        $this->RakBelanjaModel->update($id, $data);

        return redirect()->to('rakbelanja');
    }

    public function destroy($id)
    {
        $rak = $this->RakBelanjaModel->find($id);
        $waktu = $rak['waktu'];

        $this->RakBelanjaModel->delete($id);

        return redirect()->to("/rakbelanja/index/$waktu");
    }
}
