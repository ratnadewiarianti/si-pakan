<?php

namespace App\Models;

use CodeIgniter\Model;

class BPPajakModel extends Model
{
    protected $table            = 'bp_pajak';
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
        return $this->select('bp_pajak.*, 
                              karyawan1.nama AS kepala_dinas_nama, 
                              karyawan2.nama AS bendahara_nama')
                    ->join('karyawan AS karyawan1', 'bp_pajak.kepala_dinas = karyawan1.nip')
                    ->join('karyawan AS karyawan2', 'bp_pajak.bendahara_pengeluaran = karyawan2.nip')
                    ->findAll();
    }
}
