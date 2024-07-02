<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

class KaryawanController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data['karyawan'] = $this->karyawanModel->findAll();
        return view('karyawan/index', $data);
    }

    public function create()
    {
        return view('karyawan/create');
    }

    public function store()
{
    // Validasi data
    $validationRules = [
        'jabatan' => 'required',
        'nip' => 'required',
        'nama' => 'required',
        'kategori_pegawai' => 'required',
        'norek' => 'required',
        'keterangan' => 'required',
    ];

    // Tambahkan validasi untuk file jika status_ttd adalah "Ya"
    if ($this->request->getPost('status_ttd') == 'Ya') {
        $validationRules['file'] = 'uploaded[file]|mime_in[file,image/jpeg,image/png]|max_size[file,1024]';
    }

    // Jalankan validasi
    if (!$this->validate($validationRules)) {
        // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Inisialisasi $namaFile dengan null
    $namaFile = null;

    // Ambil file yang diunggah jika status_ttd adalah "Ya"
    if ($this->request->getPost('status_ttd') == 'Ya') {
        $file = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            // Generate nama unik untuk file
            $namaFile = $file->getRandomName();

            // Pindahkan file ke folder yang diinginkan
            $file->move(ROOTPATH . 'public/uploads/ttd', $namaFile);
        } else {
            // Jika file gagal diunggah, tampilkan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }
    }

    // Data untuk disimpan ke database
    $data = [
        'jabatan' => $this->request->getPost('jabatan'),
        'nip' => $this->request->getPost('nip'),
        'nama' => $this->request->getPost('nama'),
        'kategori_pegawai' => $this->request->getPost('kategori_pegawai'),
        'norek' => $this->request->getPost('norek'),
        'status_ttd' => $this->request->getPost('status_ttd'),
        'keterangan' => $this->request->getPost('keterangan'),
        'tahun' => session()->get('tahun'),
    ];

    // Jika file diunggah, tambahkan atribut file ke data yang akan disimpan
    if ($namaFile !== null) {
        $data['file'] = $namaFile;
    }

    // Simpan data ke database
    $this->karyawanModel->insert($data);

    // Redirect ke halaman karyawan setelah berhasil disimpan
    return redirect()->to('/karyawan');
}

     public function show($id)
    {
        $data['karyawan'] = $this->karyawanModel->find($id);
        return view('karyawan/show', $data);
    }

    public function edit($id)
    {
        $data['karyawan'] = $this->karyawanModel->find($id);
        return view('karyawan/edit', $data);
    }

    public function update($id)
{
    $karyawan = $this->karyawanModel->find($id);
    $file = $this->request->getFile('file');

    if (empty($file) || !$file->isValid()) {
        // Jika tidak ada file yang diunggah atau tidak valid, update data karyawan
        $data = [
            'jabatan' => $this->request->getPost('jabatan'),
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'kategori_pegawai' => $this->request->getPost('kategori_pegawai'),
            'status_ttd' => $this->request->getPost('status_ttd'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
    } else {
        // Jika ada file yang diunggah, simpan file ke direktori yang diinginkan
        if ($file->isValid() && !$file->hasMoved()) {
            // Hapus foto lama jika ada
            if ($karyawan['file']) {
                $filePath = ROOTPATH . 'public/uploads/ttd/' . $karyawan['file'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }

            // Pindahkan foto baru ke direktori yang diinginkan
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/ttd', $newName);
            $data['file'] = $newName; // Kolom 'ttd' disimpan dengan nama file yang baru
        } else {
            // Handle error jika file tidak valid atau tidak dapat dipindahkan
            // Misalnya, file terlalu besar atau tidak didukung
            // Anda dapat menambahkan kode yang sesuai di sini
            // Di sini, kita hanya mengembalikan perintah redirect karena tidak ada pembaruan data yang dilakukan.
            return redirect()->back()->with('error', 'Failed to upload file. Please try again.');
        }
    }

    // Update data karyawan, termasuk file jika ada
    $data['jabatan'] = $this->request->getPost('jabatan');
    $data['nip'] = $this->request->getPost('nip');
    $data['nama'] = $this->request->getPost('nama');
    $data['kategori_pegawai'] = $this->request->getPost('kategori_pegawai');
    $data['status_ttd'] = $this->request->getPost('status_ttd');
    $data['keterangan'] = $this->request->getPost('keterangan');

    $this->karyawanModel->update($id, $data);

    return redirect()->to('/karyawan');
}



    public function delete($id)
{
    // Ambil data karyawan berdasarkan ID
    $karyawan = $this->karyawanModel->find($id);

    // Pastikan data karyawan ditemukan
    if ($karyawan) {
        // Hapus file dari folder uploads jika ada
        if ($karyawan['file']) {
            $filePath = ROOTPATH . 'public/uploads/ttd/' . $karyawan['file'];
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file
            }
        }

        // Hapus data karyawan dari database
        $this->karyawanModel->delete($id);
    }

    // Redirect ke halaman karyawan setelah berhasil dihapus
    return redirect()->to('/karyawan');
}

}
