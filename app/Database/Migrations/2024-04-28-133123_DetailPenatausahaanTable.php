<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPenataushaanTable extends Migration
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
            'id_penatausahaan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_detail_dpa' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'id_rekening' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'no_bk_umum' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'no_bk_pembantu' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'asli_123' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'sudah_terima_dari' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'uang_sebanyak' => [
                'type' => 'TEXT',
            ],
            'untuk_pembayaran' => [
                'type' => 'TEXT',
            ],
            'pajak_daerah' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'pph21' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'terbilang' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'status_kwitansi' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'status_verifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => 10
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
        $this->forge->createTable('detail_penatausahaan');
    }

    public function down()
    {
        $this->forge->dropTable('detail_penatausahaan');
    }
}
