<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    protected $table            = 'kelompok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_akun','kode_kelompok','uraian_kelompok', 'tahun'];

    public function getData()
    {
        return $this->select('kelompok.id, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok) AS kode_kelompok, uraian_kelompok, kelompok.tahun')
            ->join('akun', 'akun.id = kelompok.id_akun')
            ->findAll();
    }

}
