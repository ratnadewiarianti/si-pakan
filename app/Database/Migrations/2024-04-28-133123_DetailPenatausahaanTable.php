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
            'untuk_pembayaran' => [
                'type' => 'TEXT',
            ],
            'status_verifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'verifikasi_bendahara' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'verifikasi_kasubbag' => [
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
