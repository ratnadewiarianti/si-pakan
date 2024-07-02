<?php

namespace App\Models;

use CodeIgniter\Model;

class BPKasTunaiModel extends Model
{
    protected $table            = 'bp_kas_tunai';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['tanggal', 'tgl_mulai', 'tgl_selesai', 'kepala_dinas', 'bendahara_pengeluaran', 'tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKaryawan()
    {
        return $this->select('bp_kas_tunai.*, 
                              karyawan1.nama AS kepala_dinas_nama, 
                              karyawan2.nama AS bendahara_nama')
                    ->join('karyawan AS karyawan1', 'bp_kas_tunai.kepala_dinas = karyawan1.nip')
                    ->join('karyawan AS karyawan2', 'bp_kas_tunai.bendahara_pengeluaran = karyawan2.nip')
                    ->findAll();
    }

    public function getCetak($id)
    {
        return $this->select('bp_kas_tunai.tanggal, bp_kas_tunai.tahun, bp_kas_tunai.tgl_selesai, bp_kas_tunai.tgl_mulai, bp_kas_tunai.kepala_dinas, bp_kas_tunai.bendahara_pengeluaran,
                              karyawan1.nama AS kepala_dinas_nama, karyawan1.jabatan AS jabatan_kepala_dinas, karyawan1.file AS ttd_kepala_dinas,
                              karyawan2.nama AS bendahara_nama, karyawan2.jabatan AS jabatan_bendahara, karyawan2.file AS ttd_bendahara')
                    ->join('karyawan AS karyawan1', 'karyawan1.nip =bp_kas_tunai.kepala_dinas')
                    ->join('karyawan AS karyawan2', 'karyawan2.nip = bp_kas_tunai.bendahara_pengeluaran')
                    ->where('bp_kas_tunai.id', $id)
                    ->findAll();
    }

    // baru bikin tabel untuk laporan sisanya belum, verifikasi belum bikin pinbuk, sama status verifikasinya belum mengarah ke arah yang benar. button blm di benarkan juga. bagian verifikasi lah. belum di php spark migrate juga.

    


}
