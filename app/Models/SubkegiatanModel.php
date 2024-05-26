<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkegiatanModel extends Model
{
    protected $table            = 'subkegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_kegiatan','kode_subkegiatan','nama_subkegiatan', 'bidang', 'kode_bidang'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSubkegiatan()
    {
        return $this->select('subkegiatan.id, CONCAT(urusan.kode_urusan, \'.\', bidang_urusan.kode_bidang_urusan ,\'.\', program.kode_program,\'.\', kegiatan.kode_kegiatan,\'.\', subkegiatan.kode_subkegiatan) AS kode_subkegiatan1, nama_subkegiatan AS nama_subkegiatan, subkegiatan.bidang, subkegiatan.kode_bidang')
        ->join('kegiatan', 'kegiatan.id = subkegiatan.id_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->findAll();
    }
  
}
