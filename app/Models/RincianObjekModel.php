<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianObjekModel extends Model
{
    protected $table            = 'rincian_objek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    =  ['id_objek','kode_rincian_objek','uraian_rincian_objek', 'tahun'];

    public function getData()
    {
        return $this->select('rincian_objek.id, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek) AS kode_rincian_objek, uraian_rincian_objek' )
        ->join('objek', 'objek.id = rincian_objek.id_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->findAll();
    }
}
