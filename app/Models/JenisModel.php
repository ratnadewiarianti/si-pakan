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

    public function getUraianJenis($id)
    {
        $row = $this->select('jenis.uraian_jenis')
        ->join('objek', 'jenis.id = objek.id_jenis')
        ->join('rincian_objek', 'objek.id = rincian_objek.id_objek')
        ->join('sub_rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('detail_dpa', 'sub_rincian_objek.id = detail_dpa.id_rekening')
        ->join('detail_penatausahaan as dp', 'detail_dpa.id = dp.id_detail_dpa')
        ->where('dp.id', $id)
            ->first(); // Use first() to get a single row

        return $row ? $row['uraian_jenis'] : ''; // Return the value or an empty string if no row found
    }
}
