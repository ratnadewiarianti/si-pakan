<?php

namespace App\Models;

use CodeIgniter\Model;

class BPSimpananBankModel extends Model
{
    protected $table            = 'bp_simpanan_bank';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['tanggal', 'tgl_mulai', 'tgl_selesai', 'kepala_dinas', 'bendahara_pengeluaran'];

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
}
