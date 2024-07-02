<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\LaporanModel;
class Home extends BaseController
{

    protected $BeritaModel;
    protected $LaporanModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->LaporanModel = new LaporanModel();
    }

    public function index()
    {
        $laporan = $this->LaporanModel->getDiagram(); 
        if (!empty($laporan)) {
            foreach ($laporan as &$item) {
                $item['jumlahdpa'] = $this->LaporanModel->getTotalJumlah($item['id_detail_dpa']);
            }
        }
        $data['laporan'] = $laporan;
        $data['berita'] = $this->BeritaModel->where('status','on')->findAll();
        return view('dashboard',$data);
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
            'file' => 'uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]'
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $filePath = ROOTPATH . 'public/uploads/berita/' . $namaFile;
            // Pindahkan file ke folder yang diinginkan
            $file->move(ROOTPATH . 'public/uploads/berita/', $namaFile);
            $this->centerCropSquare($filePath);
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
            // Jika tidak ada file yang diunggah atau tidak valid, update data berita
            $data = [
                'status' => 'off',
                'judul' => $this->request->getPost('judul'),

                'berita' => $this->request->getPost('berita'),
                'tahun' => session()->get('tahun'),
            ];
        } else {
            // Jika ada file yang diunggah, simpan file ke direktori yang diinginkan
            if ($file->isValid() && !$file->hasMoved()) {
                // Hapus foto lama jika ada
                if ($berita['file']) {
                    $filePath = ROOTPATH . 'public/uploads/berita/' . $berita['file'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Hapus file
                    }
                }

                // Pindahkan foto baru ke direktori yang diinginkan
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/berita/', $newName);
                $data = [
                    'status' => 'off',
                    'judul' => $this->request->getPost('judul'),
                    'file' => $newName,
                    'berita' => $this->request->getPost('berita'),
                    'tahun' => session()->get('tahun'),
                ];
            } else {
                // Handle error jika file tidak valid atau tidak dapat dipindahkan
                // Misalnya, file terlalu besar atau tidak didukung
                // Anda dapat menambahkan kode yang sesuai di sini
                // Di sini, kita hanya mengembalikan perintah redirect karena tidak ada pembaruan data yang dilakukan.
                return redirect()->back()->with('error', 'Failed to upload file. Please try again.');
            }
        }

        $this->BeritaModel->update($id, $data);

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
