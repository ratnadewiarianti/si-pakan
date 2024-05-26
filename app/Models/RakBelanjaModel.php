<?php

namespace App\Models;

use CodeIgniter\Model;

class RakBelanjaModel extends Model
{
    protected $table            = 'rak_belanja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['nm_subkegiatan', 'id_rekening', 'nilai_rincian'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    // public function findData()
    // {
    //     $builder = $this->db->table('rak_belanja');
    //     $builder->select('
    //         rak_belanja.*,
    //         data_rekening.akun,
    //         data_rekening.kelompok,
    //         data_rekening.jenis,
    //         data_rekening.objek,
    //         data_rekening.rincian_object,
    //         data_rekening.sub_rincian_objek,
    //         data_rekening.uraian_akun
    //                 ');
    //     $builder->join('data_rekening', 'data_rekening.id = rak_belanja.id_rekening');
    //     $query = $builder->get();

    //     return $query->getResultArray();
    // }

    public function findData()
    {
        return $this->select('rak_belanja.*, sub_rincian_objek.id as id_rekening, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun')
            ->join('sub_rincian_objek', 'sub_rincian_objek.id = rak_belanja.id_rekening')
            ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
            ->join('objek', 'objek.id = rincian_objek.id_objek')
            ->join('jenis', 'jenis.id = objek.id_jenis')
            ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
            ->join('akun', 'akun.id = kelompok.id_akun')
            ->findAll();
    }


    public function findDatabyId($id)
    {
        return $this->select('rak_belanja.*, sub_rincian_objek.id as id_rekening, CONCAT(akun.kode_akun, \'.\', kelompok.kode_kelompok, \'.\', jenis.kode_jenis, \'.\', objek.kode_objek, \'.\', rincian_objek.kode_rincian_objek, \'.\', sub_rincian_objek.kode_sub_rincian_objek) AS kode_rekening, uraian_sub_rincian_objek AS uraian_akun')
            ->join('sub_rincian_objek', 'sub_rincian_objek.id = rak_belanja.id_rekening')
            ->join('rincian_objek', 'rincian_objek.id = sub_rincian_objek.id_rincian_objek')
            ->join('objek', 'objek.id = rincian_objek.id_objek')
            ->join('jenis', 'jenis.id = objek.id_jenis')
            ->join('kelompok', 'kelompok.id = jenis.id_kelompok')
            ->join('akun', 'akun.id = kelompok.id_akun')
            ->where('rak_belanja.id', $id)
            ->get()
            ->getResultArray();
    }

    public function getTotalRak($id)
    {
        $query =  $this->db->table('detail_rakbelanja')
            ->selectSum('nilai')
            ->where('id_rakbelanja', $id)
            ->get();

        return $query->getRow()->nilai;
    }
}
