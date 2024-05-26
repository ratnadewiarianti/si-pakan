<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakModel extends Model
{
    protected $table            = 'pajak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['nama_pajak','persen'];

  
}
