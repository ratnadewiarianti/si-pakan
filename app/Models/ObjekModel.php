<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjekModel extends Model
{
    protected $table            = 'objek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
  
    protected $allowedFields    = ['id_jenis', 'kode_objek', 'uraian_objek', 'tahun'];

    public function getData()
    {
        return $this->select('objek.id, objek.tahun, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek) AS kode_objek, uraian_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->findAll();
    }
   
}
