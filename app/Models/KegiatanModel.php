<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table            = 'kegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_program','kode_kegiatan','nama_kegiatan'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKegiatan()
    {
        return $this->select('kegiatan.id, CONCAT(urusan.kode_urusan, \'.\', bidang_urusan.kode_bidang_urusan ,\'.\', program.kode_program,\'.\', kegiatan.kode_kegiatan) AS kode_kegiatan1, kegiatan.nama_kegiatan')
        ->join('program', 'program.id = kegiatan.id_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->findAll();
    }
  
}
