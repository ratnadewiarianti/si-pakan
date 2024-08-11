<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\LaporanModel;
use CodeIgniter\Files\File;
use App\Models\DetailPenatausahaanModel;
use App\Models\JenisModel;
use App\Models\KeteranganModel;
use App\Models\SubkegiatanModel;

class Home extends BaseController
{

    protected $BeritaModel;
    protected $LaporanModel;
    protected $DetailPenatausahaanModel;
    protected $KeteranganModel;
    protected $SubkegiatanModel;


    protected $JenisModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->LaporanModel = new LaporanModel();
        $this->DetailPenatausahaanModel = new DetailPenatausahaanModel();
        $this->KeteranganModel = new KeteranganModel();
        $this->JenisModel = new JenisModel();
        $this->SubkegiatanModel = new SubkegiatanModel();
    }

    // public function index1()
    // {
    //     $subkegiatan = $this->SubkegiatanModel->findAll();
    //     if (!empty($subkegiatan)) {
    //         foreach ($subkegiatan as &$sub) {
    //            $ddpa = $this->SubkegiatanModel

    //            ;

    //         }
    //     }

    //     $data['laporan'] = $laporan;
    //     $data['berita'] = $this->BeritaModel->where('status', 'on')->findAll();
    //     return view('dashboard', $data);
    // }
    public function index()
    {
        $laporan = $this->SubkegiatanModel->getDiagram();
  

        $detailp = $this->DetailPenatausahaanModel->where('verifikasi_kasubbag', 'DITERIMA')->findAll();
        $detaildata = []; // Initialize detaildata array

        foreach ($detailp as $detail) {
            $jumlahdpa = $this->LaporanModel->getTotalJumlah($detail['id_detail_dpa']);
            $uraian =  $this->JenisModel->getUraianJenis($detail['id']);
            $keterangan = $this->KeteranganModel->getKeterangan($detail['id']); // Adjusted to use new model method

            // Only proceed if keterangan exists
            if (!empty($keterangan)) {
                $totalKet = 0; // Initialize totalKet for accumulating totals from keterangan

                foreach ($keterangan as $ket) {
                    $jumlah = is_numeric($ket['jumlah']) ? (float)$ket['jumlah'] : 0;
                    $harga = is_numeric($ket['harga']) ? (float)$ket['harga'] : 0;
                    $total = $jumlah * $harga;
                    $totalKet += $total; // Accumulate total from each keterangan entry
                }

                // Push the complete data set for each detail into detaildata
                $detaildata[] = [
                    'uraian' => $uraian,
                    'jumlahdpa' => $jumlahdpa,
                    'totalket' => $totalKet, // Assign accumulated totalKet
                ];
            }
        }

        // // Log the data for debugging
        // var_dump('info', 'Detailp Data: ' . print_r($detaildata, true));

        $data['detailp'] = $detaildata;
        $data['laporan'] = $laporan;
        $data['berita'] = $this->BeritaModel->where('status', 'on')->findAll();
        return view('dashboard', $data);
    }



    public function berita()
    {
        $data['berita'] = $this->BeritaModel->findAll();
        return view('berita/index', $data);
    }

    public function create()
    {
        return view('berita/create');
    }

    public function store()
    {
        $validationRules = [
            'file' => 'uploaded[file]|max_size[file,10240]|ext_in[file,jpg,jpeg,gif,png,pdf]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $filePath = ROOTPATH . 'public/uploads/berita/' . $namaFile;

            $file->move(ROOTPATH . 'public/uploads/berita/', $namaFile);

            $mimeType = $file->getClientMimeType();
            if (in_array($mimeType, ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'])) {
                $this->centerCropSquare($filePath);
            }

            $data = [
                'status' => 'off',
                'judul' => $this->request->getPost('judul'),
                'file' => $namaFile,
                'berita' => $this->request->getPost('berita'),
                'tahun' => session()->get('tahun'),
            ];

            $this->BeritaModel->insert($data);
            return redirect()->to('/berita');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }
    }



    public function edit($id)
    {
        $data['berita'] = $this->BeritaModel->find($id);
        return view('berita/edit', $data);
    }

    public function update($id)
    {
        $berita = $this->BeritaModel->find($id);
        $file = $this->request->getFile('file');

        if (empty($file) || !$file->isValid()) {
            // Jika tidak ada file yang diunggah atau tidak valid, update data berita tanpa mengubah file
            $data = [
                'judul' => $this->request->getPost('judul'),
                'berita' => $this->request->getPost('berita'),
                'tahun' => session()->get('tahun'),
            ];
        } else {
            // Jika ada file yang diunggah, simpan file ke direktori yang diinginkan
            if ($file->isValid() && !$file->hasMoved()) {
                // Hapus file lama jika ada
                if ($berita['file']) {
                    $filePath = ROOTPATH . 'public/uploads/berita/' . $berita['file'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Hapus file lama
                    }
                }

                // Pindahkan file baru ke direktori yang diinginkan
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/berita/', $newName);

                // Update data berita termasuk nama file baru
                $data = [
                    'judul' => $this->request->getPost('judul'),
                    'file' => $newName,
                    'berita' => $this->request->getPost('berita'),
                    'tahun' => session()->get('tahun'),
                ];
            } else {
                // Handle error jika file tidak valid atau tidak dapat dipindahkan
                return redirect()->back()->with('error', 'Failed to upload file. Please try again.');
            }
        }

        // Update data berita di database
        $this->BeritaModel->update($id, $data);

        // Redirect ke halaman berita setelah berhasil diupdate
        return redirect()->to('/berita');
    }

    private function centerCropSquare($filePath)
    {
        $image = \Config\Services::image()
            ->withFile($filePath)
            ->fit(400, 400, 'center')
            ->save($filePath);
    }

    public function starter()
    {
        $title = 'Halaman starter';
        return view('dash_example');
    }


    public function delete($id)
    {
        // Ambil data karyawan berdasarkan ID
        $berita = $this->BeritaModel->find($id);

        // Pastikan data berita ditemukan
        if ($berita) {
            // Hapus file dari folder uploads jika ada
            if ($berita['file']) {
                $filePath = ROOTPATH . 'public/uploads/berita/' . $berita['file'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }

            // Hapus data berita dari database
            $this->BeritaModel->delete($id);
        }

        // Redirect ke halaman karyawan setelah berhasil dihapus
        return redirect()->to('/berita');
    }

    public function aktivasi($id)
    {
        $request = $this->request->getJSON(); // Ambil data JSON dari permintaan

        $status = $request->status === 'on' ? 'on' : 'off'; // Pastikan status yang diterima adalah 'on' atau 'off'

        $model = new BeritaModel();
        $model->update($id, ['status' => $status]);

        return $this->response->setJSON(['success' => true, 'status' => $status]);
    }
}
