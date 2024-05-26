<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailDPAModel extends Model
{
    protected $table            = 'detail_dpa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_dpa','id_subkegiatan','id_rekening','jumlah','jumlah_perubahan'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDetailDPA($id)
{
    $query = $this->db->table('detail_dpa')
        ->select('
            detail_dpa.id, detail_dpa.id_dpa, detail_dpa.jumlah, detail_dpa.jumlah_perubahan, 
            detail_dpa.id_subkegiatan, detail_dpa.id_rekening, 
            subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, 
            urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, 
            kegiatan.kode_kegiatan, program.kode_program, 
            sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, 
            akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, 
            dpa.nomor_dpa'
        )
        ->join('dpa', 'dpa.id = detail_dpa.id_dpa')
        ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_dpa.id_rekening')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('objek', 'objek.id = rincian_objek.id_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->where('detail_dpa.id_dpa', $id)
        ->get();

    return $query->getResultArray();
}


    public function getDPA()
    {
        return  $this->select('detail_dpa.*, dpa.nomor_dpa, subkegiatan.kode_subkegiatan, subkegiatan.nomenklatur_urusan_provinsi, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program')
        ->join('dpa', 'dpa.id = detail_dpa.id_dpa')
        ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->findAll();
    }

    public function getTotalJumlah($id)
{
    $query = $this->db->table('detail_dpa_subkegiatan')
        ->selectSum('jumlah', 'total_jumlah') // Menggunakan alias untuk hasil sum
        ->where('id_detail_dpa', $id)
        ->get();

    $result = $query->getRow();
    return $result ? $result->total_jumlah : 0; // Mengakses alias dari hasil sum, cek null
}

public function getTotalJumlahPerubahan($id)
{
    $query = $this->db->table('detail_dpa_subkegiatan')
        ->selectSum('jumlah_perubahan', 'total_jumlah_perubahan') // Menggunakan alias untuk hasil sum
        ->where('id_detail_dpa', $id)
        ->get();

    $result = $query->getRow();
    return $result ? $result->total_jumlah_perubahan : 0; // Mengakses alias dari hasil sum, cek null
}



}
