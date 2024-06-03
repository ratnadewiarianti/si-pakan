<?php

namespace App\Models;

use CodeIgniter\Model;

class DPAModel extends Model
{
    protected $table            = 'dpa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['nomor_dpa','tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findData()
    {
        return $this->select('dpa.*, subkegiatan.id as id_subkegiatan, CONCAT(urusan.kode_urusan, \'.\', bidang_urusan.kode_bidang_urusan, \'.\', program.kode_program, \'.\', kegiatan.kode_kegiatan, \'.\', subkegiatan.kode_subkegiatan) AS kode_rekening, nomenklatur_urusan_provinsi AS nama_subkegiatan')
        ->join('subkegiatan', 'subkegiatan.id = dpa.id_subkegiatan')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = subkegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = subkegiatan.id_bidang_urusan')
        ->join('urusan', 'urusan.id = subkegiatan.id_urusan')
        ->findAll();
    }


}
