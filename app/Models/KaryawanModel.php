<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $allowedFields    = [
        'jabatan',
        'nip',
        'nama',
        'kategori_pegawai',
        'norek',
        'keterangan',
        'status_ttd',
        'file',
        'tahun'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKaryawanwithPNS() 
    {
        // Query builder untuk mengambil data karyawan dengan kategori pegawai PNS
        return $this->where('kategori_pegawai', 'PNS')->findAll();
    }

    public function getKaryawanwithPTT() 
    {
        // Query builder untuk mengambil data karyawan dengan kategori pegawai PTT
        return $this->where('kategori_pegawai', 'PTT')->findAll();
    }

    public function getKaryawanwithTenaga() 
    {
        // Query builder untuk mengambil data karyawan dengan kategori pegawai Tenaga Ahli
        return $this->where('kategori_pegawai', 'Tenaga Ahli')->findAll();
    }


}
