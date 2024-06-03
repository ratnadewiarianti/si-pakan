<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangUrusanModel extends Model
{
    protected $table            = 'bidang_urusan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_urusan','kode_bidang_urusan','nama_bidang_urusan','tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
    public function getBidangUrusan()
    {
        // Query builder untuk mengambil data indikator_kinerja_urusan beserta data urusan terkait.
        $query = $this->db->table('bidang_urusan')
            ->select('bidang_urusan.id, bidang_urusan.kode_bidang_urusan, bidang_urusan.nama_bidang_urusan, bidang_urusan.tahun, urusan.kode_urusan, urusan.nama_urusan')
            ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
            // ->where('bidang_urusan.tahun',session()->get('tahun'))
            ->get();
        
        return $query->getResultArray();
    }


  
}
