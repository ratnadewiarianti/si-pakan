<?php

namespace App\Models;

use CodeIgniter\Model;

class DataRekeningModel extends Model
{
    protected $table            = 'data_rekening';
    protected $allowedFields    = [
        'akun', 
        'kelompok', 
        'jenis', 
        'objek', 
        'rincian_object', 
        'sub_rincian_objek',
        'uraian_akun',
        'tahun',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
