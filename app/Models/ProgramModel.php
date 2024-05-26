<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table            = 'program';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields    = ['id_bidang_urusan','kode_program','nama_program'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProgram()
    {
        return $this->select('program.id, CONCAT(urusan.kode_urusan, \'.\', bidang_urusan.kode_bidang_urusan ,\'.\', program.kode_program) AS kode_program1, program.nama_program')
        ->join('bidang_urusan', 'bidang_urusan.id = program.id_bidang_urusan')
        ->join('urusan', 'urusan.id = bidang_urusan.id_urusan')
        ->findAll();
    }

    

  
}
