<?php

namespace App\Models;

use CodeIgniter\Model;

class UrusanModel extends Model
{
    protected $table            = 'urusan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['kode_urusan','nama_urusan', 'tahun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


  
}
