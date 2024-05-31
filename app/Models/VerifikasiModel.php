<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends Model
{
    protected $table            = 'verifikasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_detail_penatausahaan','nomor_bku', 'tanggal', 'uraian', 'nilai_spj', 'ppn', 'pph_psl_23', 'pph_psl_22', 'pph_psl_21', 'pajak_daerah', 'diterima', 'file_spj', 'file_kwitansi', 'status_bendahara', 'status_kasubbag', 'status_pptik', 'status_verifikator_keuangan'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';




    public function verifikasi()
    {
        return $this->select('verifikasi.*, detail_penatausahaan.id_detail_dpa, detail_penatausahaan.id_rekening, detail_dpa.id_subkegiatan, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, sub_rincian_objek.uraian_sub_rincian_objek')
        ->join('detail_penatausahaan', 'detail_penatausahaan.id = verifikasi.id_detail_penatausahaan')
        ->join('detail_dpa', 'detail_dpa.id = detail_penatausahaan.id_detail_dpa')
        ->join('subkegiatan', 'subkegiatan.id = detail_dpa.id_subkegiatan')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_penatausahaan.id_rekening')
            ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
            ->join('objek', 'objek.id = rincian_objek.id_objek')
            ->join('jenis', 'jenis.id = objek.id_jenis')
            ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
            ->join('akun', 'akun.id = kelompok.id_akun')
        ->findAll();
    }




    public function updateStatusBendahara($id, $status)
{
    $data = [
        'status_bendahara' => $status
    ];

    $this->where('id', $id)->set($data)->update();

    // Periksa apakah ada baris yang terpengaruh (diupdate)
    return $this->db->affectedRows() > 0;
}

}
