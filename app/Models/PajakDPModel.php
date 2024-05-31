<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakDPModel extends Model
{
    protected $table            = 'pajak_dp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_dp','id_pajak'];


    public function getPajak($id){
        return $this->select('pajak.nama_pajak, pajak.persen')
        ->join('pajak','pajak.id = pajak_dp.id_pajak')
        ->where('pajak_dp.id_dp',$id)
        ->findAll();
    }
}
