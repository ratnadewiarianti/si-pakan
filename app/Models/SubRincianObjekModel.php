<?php

namespace App\Models;

use CodeIgniter\Model;

class SubRincianObjekModel extends Model
{
    protected $table            = 'sub_rincian_objek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
  
    protected $allowedFields    = ['id_rincian_objek','kode_sub_rincian_objek','uraian_sub_rincian_objek'];

    public function getRekening()
    {
        return $this->select('sub_rincian_objek.id, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('objek', 'objek.id = rincian_objek.id_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->findAll();
    }

    

}
