<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BukuPembantuSimpananBank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'tgl_mulai' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'tgl_selesai' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'tanggal' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'kepala_dinas' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
            ],
            'jabatan_kepala_dinas' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
            ],
            'bendahara_pengeluaran' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
            ],
            'jabatan_bendahara_pengeluaran' => [
                'type' => 'VARCHAR', 
                'constraint' => 100
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bp_simpanan_bank');
    }

    public function down()
    {
        $this->forge->dropTable('bp_simpanan_bank');
    }
}
