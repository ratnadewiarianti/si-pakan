<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_detail_dpa' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'realisasi' => ['type' => 'VARCHAR', 'constraint' => 100],
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
        $this->forge->createTable('laporan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan');
    }
}
