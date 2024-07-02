<?php

namespace App\Models;

use CodeIgniter\Model;

class BPSimpananBankModel extends Model
{
    protected $table            = 'bp_simpanan_bank';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['tanggal', 'tgl_mulai', 'tgl_selesai', 'kepala_dinas', 'bendahara_pengeluaran', 'tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // baru bikin tabel untuk laporan sisanya belum, verifikasi belum bikin pinbuk, sama status verifikasinya belum mengarah ke arah yang benar. button blm di benarkan juga. bagian verifikasi lah. belum di php spark migrate juga.
    public function getKaryawan()
    {
        return $this->select('bp_simpanan_bank.*, 
                              karyawan1.nama AS kepala_dinas_nama, 
                              karyawan2.nama AS bendahara_nama')
                    ->join('karyawan AS karyawan1', 'bp_simpanan_bank.kepala_dinas = karyawan1.nip')
                    ->join('karyawan AS karyawan2', 'bp_simpanan_bank.bendahara_pengeluaran = karyawan2.nip')
                    ->findAll();
    }


    public function getCetak($id)
    {
        return $this->select('bp_simpanan_bank.tanggal, bp_simpanan_bank.tahun, bp_simpanan_bank.tgl_selesai, bp_simpanan_bank.tgl_mulai, bp_simpanan_bank.kepala_dinas, bp_simpanan_bank.bendahara_pengeluaran,
                              karyawan1.nama AS kepala_dinas_nama, karyawan1.jabatan AS jabatan_kepala_dinas, karyawan1.file AS ttd_kepala_dinas,
                              karyawan2.nama AS bendahara_nama, karyawan2.jabatan AS jabatan_bendahara, karyawan2.file AS ttd_bendahara')
        ->join('karyawan AS karyawan1', 'karyawan1.nip =bp_simpanan_bank.kepala_dinas')
        ->join('karyawan AS karyawan2', 'karyawan2.nip = bp_simpanan_bank.bendahara_pengeluaran')
        ->where('bp_simpanan_bank.id', $id)
            ->findAll();
    }
}
