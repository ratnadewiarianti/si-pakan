<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table            = 'jenis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    =  ['id_kelompok','kode_jenis','uraian_jenis','tahun'];

    public function getData()
    {
        return $this->select('jenis.id, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis) AS kode_jenis, uraian_jenis, jenis.tahun' )
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->findAll();
    }
}
