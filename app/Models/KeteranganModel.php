<?php

namespace App\Models;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
    protected $table            = 'keterangan_penatausahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'id_detail_penatausahaan',
        'keperluan',
        'harga',
        'jumlah',
        'tahun'

    ];

    
}
