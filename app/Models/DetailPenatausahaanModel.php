<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPenatausahaanModel extends Model
{
    protected $table            = 'detail_penatausahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'id_penatausahaan',
        'id_detail_dpa',
        // 'id_rekening',
        'no_bk_umum',
        'no_bk_pembantu',
        'asli_123',
        'sudah_terima_dari',
        // 'uang_sebanyak',
        'untuk_pembayaran',
        // 'terbilang',
        'status_kwitansi',
        'status_verifikasi',
        'verifikasi_bendahara',
        'verifikasi_kasubbag',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

  
public function getDetail($id)
{
    return $this->select('detail_penatausahaan.*, dpa.nomor_dpa, 
        CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, 
        sub_rincian_objek.uraian_sub_rincian_objek, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, 
        urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program')
        ->join('detail_dpa','detail_dpa.id = detail_penatausahaan.id_detail_dpa')
        ->join('dpa','dpa.id = detail_dpa.id_dpa')
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
        ->where('detail_penatausahaan.id_penatausahaan', $id)
        ->findAll();
}
    

    public function getDetailById($id)
{
    return $this->select('detail_penatausahaan.*, dpa.nomor_dpa, 
        CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, 
        sub_rincian_objek.uraian_sub_rincian_objek, 
        subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, 
        urusan.kode_urusan, urusan.nama_urusan, 
        bidang_urusan.kode_bidang_urusan, bidang_urusan.nama_bidang_urusan, 
        kegiatan.kode_kegiatan, kegiatan.nama_kegiatan, 
        program.kode_program, program.nama_program')
    ->join('detail_dpa', 'detail_dpa.id = detail_penatausahaan.id_detail_dpa')
    ->join('dpa', 'dpa.id = detail_dpa.id_dpa')
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
    ->where('detail_penatausahaan.id', $id)
    ->first();
}


    public function getDetailPenatausahaan()
    {
        return $this->select('detail_penatausahaan.*,dpa.nomor_dpa, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening')
            ->join('sub_rincian_objek', 'sub_rincian_objek.id = detail_dpa.id_rekening')
            ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
            ->join('objek', 'objek.id = rincian_objek.id_objek')
            ->join('jenis', 'jenis.id = objek.id_jenis')
            ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
            ->join('akun', 'akun.id = kelompok.id_akun')
            ->join('detail_dpa','detail_dpa.id = detail_penatausahaan.id_detail_dpa')
            ->join('dpa','dpa.id = detail_dpa.id_dpa')
            ->findAll();
    }

    public function updateStatusVerifikasi($id, $status)
{
    $data = [
        'status_verifikasi' => $status
    ];

    $this->where('id', $id)->set($data)->update();

    // Periksa apakah ada baris yang terpengaruh (diupdate)
    return $this->db->affectedRows() > 0;
}

public function getCariDataVerifikasi()
    {
        return $this->select('detail_penatausahaan.*,dpa.nomor_dpa, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening,sub_rincian_objek.uraian_sub_rincian_objek, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program')
            ->join('detail_dpa','detail_dpa.id = detail_penatausahaan.id_detail_dpa')
            ->join('dpa','dpa.id = detail_dpa.id_dpa')
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
            // ->where('detail_penatausahaan.id_penatausahaan')
            ->findAll();
    }

    public function getVerifikasi()
    {
        return $this->select('detail_penatausahaan.*,dpa.nomor_dpa, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening,sub_rincian_objek.uraian_sub_rincian_objek, subkegiatan.kode_subkegiatan, subkegiatan.nama_subkegiatan, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program, penatausahaan.link_google')
            ->join('penatausahaan', 'penatausahaan.id = detail_penatausahaan.id_penatausahaan')
            ->join('detail_dpa','detail_dpa.id = detail_penatausahaan.id_detail_dpa')
            ->join('dpa','dpa.id = detail_dpa.id_dpa')
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

    public function getTotalJumlah()
{
    $query = $this->db->table('detail_dpa_subkegiatan')
        ->selectSum('jumlah', 'total_jumlah') // Menggunakan alias untuk hasil sum
        ->where('id_detail_dpa')
        ->get();

    $result = $query->getRow();
    return $result ? $result->total_jumlah : 0; // Mengakses alias dari hasil sum, cek null
}

   

}
