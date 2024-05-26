<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailDPASubkegiatanModel extends Model
{
    protected $table            = 'detail_dpa_subkegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_detail_dpa','uraian','koefisien','satuan','harga','ppn','jumlah','keterangan','koefisien_perubahan','satuan_perubahan','harga_perubahan','ppn_perubahan','jumlah_perubahan','keterangan_perubahan'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDetailDPASubkegiatan($id)
    {
        $query = $this->db->table('detail_dpa_subkegiatan')
            ->select('detail_dpa_subkegiatan.id,  detail_dpa_subkegiatan.id_detail_dpa, detail_dpa_subkegiatan.uraian, detail_dpa_subkegiatan.koefisien, detail_dpa_subkegiatan.satuan, detail_dpa_subkegiatan.harga, detail_dpa_subkegiatan.ppn, detail_dpa_subkegiatan.jumlah, detail_dpa_subkegiatan.keterangan, detail_dpa_subkegiatan.koefisien_perubahan, detail_dpa_subkegiatan.satuan_perubahan, detail_dpa_subkegiatan.harga_perubahan, detail_dpa_subkegiatan.ppn_perubahan, detail_dpa_subkegiatan.jumlah_perubahan, detail_dpa_subkegiatan.keterangan_perubahan, detail_dpa.id_subkegiatan, detail_dpa.id_rekening, subkegiatan.kode_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program,')
            ->join('detail_dpa', 'detail_dpa.id = detail_dpa_subkegiatan.id_detail_dpa')
            ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
            ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
            ->join('program', 'program.id = kegiatan.id_program')
            ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
            ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
            ->where('detail_dpa_subkegiatan.id_detail_dpa', $id) // Filter sesuai dengan ID yang diberikan
            ->get(); 
    
        return $query->getResultArray();
    }

   
}
