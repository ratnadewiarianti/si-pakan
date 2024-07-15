<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'laporan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_detail_dpa', 'realisasi', 'tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
    public function getRekening()
    {
        $query = $this->db->table('laporan')
            ->select('laporan.id_detail_dpa, laporan.realisasi, laporan.tahun,laporan.id as idlaporan,
                detail_dpa.id, detail_dpa.id_dpa, detail_dpa.jumlah, detail_dpa.jumlah_perubahan, 
                detail_dpa.id_subkegiatan, detail_dpa.id_rekening, 
                subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, 
                urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, 
                kegiatan.kode_kegiatan, program.kode_program, 
                sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, 
                akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, 
                dpa.nomor_dpa'
            )
            ->join('detail_dpa', 'detail_dpa.id = laporan.id_detail_dpa')
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
            ->get();
    
        return $query->getResultArray();
    }

    public function getTotalJumlah()
    {
        $query = $this->db->table('detail_dpa_subkegiatan')
            ->selectSum('jumlah', 'total_jumlah') // Menggunakan alias untuk hasil sum
            // ->where('id_detail_dpa', $id)
            ->get();
    
        $result = $query->getRow();
        return $result ? $result->total_jumlah : 0; // Mengakses alias dari hasil sum, cek null
    }

        public function getTotalJumlahbyId($id)
    {
        $query = $this->db->table('detail_dpa_subkegiatan')
            ->selectSum('jumlah', 'total_jumlah') // Menggunakan alias untuk hasil sum
            ->where('id_detail_dpa', $id)
            ->get();
    
        $result = $query->getRow();
        return $result ? $result->total_jumlah : 0; // Mengakses alias dari hasil sum, cek null
    }

    public function getCetak($id)
{
    $query = $this->db->table('laporan')
        ->select('laporan.id AS laporan_id, laporan.id_detail_dpa, laporan.realisasi, laporan.tahun,
            detail_dpa.id AS detail_dpa_id, detail_dpa.id_dpa, detail_dpa.jumlah, detail_dpa.jumlah_perubahan, 
            detail_dpa.id_subkegiatan, detail_dpa.id_rekening, 
            subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, 
            urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, 
            kegiatan.kode_kegiatan, program.kode_program, 
            sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, 
            akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, 
            dpa.nomor_dpa'
        )
        ->join('detail_dpa', 'detail_dpa.id = laporan.id_detail_dpa')
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
        ->where('laporan.id', $id)
        ->get();
    
    return $query->getResultArray();
}


    public function getDiagram()
    {
        $query = $this->db->table('laporan')
        ->select(
            'laporan.id AS laporan_id, laporan.id_detail_dpa, laporan.realisasi, laporan.tahun,
            detail_dpa.id AS detail_dpa_id, detail_dpa.id_dpa, detail_dpa.jumlah, detail_dpa.jumlah_perubahan, 
            detail_dpa.id_subkegiatan, detail_dpa.id_rekening, 
            subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, subkegiatan.bidang,
            urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, 
            kegiatan.kode_kegiatan, program.kode_program, 
            sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, 
            akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek, 
            dpa.nomor_dpa'
        )
            ->join('detail_dpa', 'detail_dpa.id = laporan.id_detail_dpa')
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
            ->get();

        return $query->getResultArray();
    }
}
