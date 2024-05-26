<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BukuPembantuKasTunaiTable extends Migration
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
            'id_subkegiatan' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'id_sub_rincian_objek' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'tanggal' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'no_bukti' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'uraian' => [
                'type' => 'VARCHAR', 
                'constraint' => 255
            ],
            'penerimaan' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'pengeluaran' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'saldo' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'jumlah_periode_ini' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'jumlah_periode_lalu' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'jumlah_semua_periode' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'sisa_kas' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'kas_bendahara' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'kepala_dinas' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'bendahara_pengeluaran' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bp_kas_tunai');
    }

    public function down()
    {
        $this->forge->dropTable('bp_kas_tunai');
    }
}
