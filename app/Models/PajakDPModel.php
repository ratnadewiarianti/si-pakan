<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakDPModel extends Model
{
    protected $table            = 'pajak_dp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_dp','id_pajak','jumlah_p', 'tahun'];


    public function getPajak($id){
        return $this->select('pajak.nama_pajak, pajak.jenis_pajak, pajak.tahun, pajak_dp.jumlah_p')
        ->join('pajak','pajak.id = pajak_dp.id_pajak')
        ->where('pajak_dp.id_dp',$id)
        ->findAll();
    }
    public function getPajakByIdDp($id_dp)
    {
        return $this->where('id_dp', $id_dp)->findAll();
    }

    public function getTotalJumlahP($id){
        return $this->selectSum('pajak_dp.jumlah_p')
            ->join('pajak', 'pajak.id = pajak_dp.id_pajak')
            ->where('pajak_dp.id_dp', $id)
            ->first();
    }
}
