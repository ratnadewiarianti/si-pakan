<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BidangUrusanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_urusan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'kode_bidang_urusan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama_bidang_urusan' => ['type' => 'VARCHAR', 'constraint' => 100],
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
        $this->forge->createTable('bidang_urusan');
    }

    public function down()
    {
        $this->forge->dropTable('bidang_urusan');
    }
}
