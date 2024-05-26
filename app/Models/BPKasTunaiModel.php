<?php

namespace App\Models;

use CodeIgniter\Model;

class BPKasTunaiModel extends Model
{
    protected $table            = 'bp_kas_tunai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_subkegiatan', 'id_sub_rincian_objek','tanggal', 'no_bukti', 'uraian', 'penerimaan', 'pengeluaran', 'saldo', 'jumlah_periode_ini', 'jumlah_periode_lalu', 'jumlah_semua_periode', 'sisa_kas', 'kas_bendahara', 'kepala_dinas', 'bendahara_pengeluaran'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBPKasTunai()
{
    $query = $this->db->table('bp_kas_tunai')
        ->select('bp_kas_tunai.id, bp_kas_tunai.id_subkegiatan, bp_kas_tunai.id_sub_rincian_objek, bp_kas_tunai.tanggal, bp_kas_tunai.no_bukti, bp_kas_tunai.uraian, bp_kas_tunai.penerimaan, bp_kas_tunai.pengeluaran, bp_kas_tunai.saldo, bp_kas_tunai.jumlah_periode_ini, bp_kas_tunai.jumlah_periode_lalu, bp_kas_tunai.jumlah_semua_periode, bp_kas_tunai.sisa_kas, bp_kas_tunai.kas_bendahara, kepala_dinas.nama as nama_kepala_dinas, bendahara_pengeluaran.nama as nama_bendahara_pengeluaran, subkegiatan.kode_subkegiatan, subkegiatan.nomenklatur_urusan_provinsi, urusan.kode_urusan, bidang_urusan.kode_bidang_urusan, kegiatan.kode_kegiatan, program.kode_program, sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek')
        ->join('subkegiatan', 'subkegiatan.id = bp_kas_tunai.id_subkegiatan')
        ->join('urusan', 'urusan.id = subkegiatan.id_urusan')
        ->join('bidang_urusan', 'bidang_urusan.id = subkegiatan.id_bidang_urusan')
        ->join('program', 'program.id = subkegiatan.id_program')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = bp_kas_tunai.id_sub_rincian_objek')
        ->join('akun', 'akun.id = sub_rincian_objek.id_akun')
        ->join('kelompok', 'kelompok.id = sub_rincian_objek.id_kelompok')
        ->join('jenis', 'jenis.id = sub_rincian_objek.id_jenis')
        ->join('objek', 'objek.id = sub_rincian_objek.id_objek')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('karyawan as kepala_dinas', 'kepala_dinas.nip = bp_kas_tunai.kepala_dinas')
        ->join('karyawan as bendahara_pengeluaran', 'bendahara_pengeluaran.nip = bp_kas_tunai.bendahara_pengeluaran')
        ->get(); 

    return $query->getResultArray();
}
    public function getBPKasTunaiById($id)
{
    return $this->select('bp_kas_tunai.id, bp_kas_tunai.id_subkegiatan, bp_kas_tunai.id_sub_rincian_objek, bp_kas_tunai.tanggal, bp_kas_tunai.no_bukti, bp_kas_tunai.uraian, bp_kas_tunai.penerimaan, bp_kas_tunai.pengeluaran, bp_kas_tunai.saldo, bp_kas_tunai.jumlah_periode_ini, bp_kas_tunai.jumlah_periode_lalu, bp_kas_tunai.jumlah_semua_periode, bp_kas_tunai.sisa_kas, bp_kas_tunai.kas_bendahara, kepala_dinas.nama as nama_kepala_dinas, bendahara_pengeluaran.nama as nama_bendahara_pengeluaran, subkegiatan.kode_subkegiatan, subkegiatan.nomenklatur_urusan_provinsi, urusan.kode_urusan, urusan.nama_urusan, bidang_urusan.kode_bidang_urusan, bidang_urusan.nama_bidang_urusan, kegiatan.nama_kegiatan, kegiatan.kode_kegiatan, program.kode_program, program.nama_program, sub_rincian_objek.uraian_sub_rincian_objek, sub_rincian_objek.kode_sub_rincian_objek, akun.kode_akun, kelompok.kode_kelompok, jenis.kode_jenis, objek.kode_objek, rincian_objek.kode_rincian_objek')
        ->join('subkegiatan', 'subkegiatan.id = bp_kas_tunai.id_subkegiatan')
        ->join('urusan', 'urusan.id = subkegiatan.id_urusan')
        ->join('bidang_urusan', 'bidang_urusan.id = subkegiatan.id_bidang_urusan')
        ->join('program', 'program.id = subkegiatan.id_program')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('sub_rincian_objek', 'sub_rincian_objek.id = bp_kas_tunai.id_sub_rincian_objek')
        ->join('akun', 'akun.id = sub_rincian_objek.id_akun')
        ->join('kelompok', 'kelompok.id = sub_rincian_objek.id_kelompok')
        ->join('jenis', 'jenis.id = sub_rincian_objek.id_jenis')
        ->join('objek', 'objek.id = sub_rincian_objek.id_objek')
        ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
        ->join('karyawan as kepala_dinas', 'kepala_dinas.nip = bp_kas_tunai.kepala_dinas')
        ->join('karyawan as bendahara_pengeluaran', 'bendahara_pengeluaran.nip = bp_kas_tunai.bendahara_pengeluaran')
        ->where('bp_kas_tunai.id', $id)
        ->first();

    // return $query->getResultArray();
}

    


}
