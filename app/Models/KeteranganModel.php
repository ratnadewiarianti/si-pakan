<?php

namespace App\Models;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
    protected $table            = 'keterangan_penatausahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'id_detail_penatausahaan',
        'id_dpa_subkegiatan',
        // 'harga',
        'jumlah',
        'tahun'

    ];

public function getKeterangan($id)
{
    return $this->select('keterangan_penatausahaan.*, detail_dpa_subkegiatan.id_detail_dpa, detail_dpa_subkegiatan.uraian, 
                  detail_dpa_subkegiatan.koefisien, detail_dpa_subkegiatan.satuan, 
                  detail_dpa_subkegiatan.harga, detail_dpa_subkegiatan.ppn, 
                  detail_dpa_subkegiatan.jumlah AS jumlah_dpa_subkegiatan, detail_dpa_subkegiatan.keterangan, 
                  detail_dpa_subkegiatan.koefisien_perubahan, detail_dpa_subkegiatan.satuan_perubahan, 
                  detail_dpa_subkegiatan.harga_perubahan, detail_dpa_subkegiatan.ppn_perubahan, 
                  detail_dpa_subkegiatan.jumlah_perubahan, detail_dpa_subkegiatan.keterangan_perubahan')
        ->join('detail_penatausahaan', 'detail_penatausahaan.id = keterangan_penatausahaan.id_detail_penatausahaan')
        ->join('detail_dpa_subkegiatan', 'detail_dpa_subkegiatan.id = keterangan_penatausahaan.id_dpa_subkegiatan')
        ->where('keterangan_penatausahaan.id_detail_penatausahaan', $id)
        ->findAll();

}

    
}
