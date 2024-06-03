<?php

namespace App\Models;

use CodeIgniter\Model;

class RakBelanjaModel extends Model
{
    protected $table            = 'rak_belanja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['nm_subkegiatan', 'id_detail_dpa', 'nilai_rincian','waktu', 'tahun'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    // public function findData()
    // {
    //     $builder = $this->db->table('rak_belanja');
    //     $builder->select('
    //         rak_belanja.*,
    //         data_rekening.akun,
    //         data_rekening.kelompok,
    //         data_rekening.jenis,
    //         data_rekening.objek,
    //         data_rekening.rincian_object,
    //         data_rekening.sub_rincian_objek,
    //         data_rekening.uraian_akun
    //                 ');
    //     $builder->join('data_rekening', 'data_rekening.id = rak_belanja.id_rekening');
    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    public function findData()
    {
        return $this->select('rak_belanja.*, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, program.kode_program, kegiatan.kode_kegiatan')
            ->join('detail_dpa', 'detail_dpa.id = rak_belanja.id_detail_dpa')
            ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_dpa.id_rekening')
            ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
            ->join('objek', 'objek.id = rincian_objek.id_objek')
            ->join('jenis', 'jenis.id = objek.id_jenis')
            ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
            ->join('akun', 'akun.id = kelompok.id_akun')
            ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
            ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
            ->join('program', 'program.id = kegiatan.id_program')
            ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
            ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
            ->findAll();
    }

    public function findDatabyTime($waktu)
    {
        return $this->select('rak_belanja.*, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, program.kode_program, kegiatan.kode_kegiatan')
        ->join('detail_dpa', 'detail_dpa.id = rak_belanja.id_detail_dpa')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_dpa.id_rekening')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('objek', 'objek.id = rincian_objek.id_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->where('rak_belanja.waktu',$waktu)
        ->findAll();
    }


    public function findDatabyId($id)
    {
        return $this->select('rak_belanja.*, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan,')
        ->join('detail_dpa', 'detail_dpa.id = rak_belanja.id_detail_dpa')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_dpa.id_rekening')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('objek', 'objek.id = rincian_objek.id_objek')
        ->join('jenis', 'jenis.id = objek.id_jenis')
        ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
        ->join('akun', 'akun.id = kelompok.id_akun')
        ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
            ->where('rak_belanja.id', $id)
            ->get()
            ->getResultArray();
    }

    public function getTotalRak($id)
    {
        $query =  $this->db->table('detail_rakbelanja')
            ->selectSum('nilai')
            ->where('id_rakbelanja', $id)
            ->get();

        return $query->getRow()->nilai;
    }
}
