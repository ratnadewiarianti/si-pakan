<?php

namespace App\Models;

use CodeIgniter\Model;

class Detail2PenatausahaanModel extends Model
{
    protected $table            = 'detail2_penatausahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_detail_penatausahaan','id_karyawan','nominal','tahun'];

 
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

   public function getAnggota($id)
   {
        return $this->select('detail2_penatausahaan.*,karyawan.nama,karyawan.nip,karyawan.jabatan')
        ->join('karyawan', 'karyawan.id = detail2_penatausahaan.id_karyawan')
        ->where('detail2_penatausahaan.id_detail_penatausahaan', $id)
            ->findAll();
   }
}
