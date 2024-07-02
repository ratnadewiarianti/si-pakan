<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailRakBelanjaModel extends Model
{
    protected $table            = 'detail_rakbelanja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_rakbelanja','bulan','nilai','tahun'];

  
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

  
}
