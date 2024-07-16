<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianPajakModel extends Model
{
    protected $table            = 'rincian_dpa_subkegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
  
    protected $allowedFields    = ['id_dp', 'id_detail_dpa_subkegiatan','tahun'];

    public function getKeterangan($id)
     {
        return $this->select('rincian_dpa_subkegiatan.id_detail_dpa_subkegiatan as id_dpa_subkegiatan,detail_dpa_subkegiatan.uraian,detail_dpa_subkegiatan.harga,detail_dpa_subkegiatan.koefisien,detail_dpa_subkegiatan.jumlah,detail_dpa_subkegiatan.satuan')
        ->join('detail_dpa_subkegiatan', 'detail_dpa_subkegiatan.id = rincian_dpa_subkegiatan.id_detail_dpa_subkegiatan')
        ->where('rincian_dpa_subkegiatan.id_dp',$id)
        ->findAll();
    }
}
