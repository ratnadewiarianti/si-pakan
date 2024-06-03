<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DPATable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nomor_dpa' => ['type' => 'VARCHAR', 'constraint' => 100],
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
        $this->forge->createTable('dpa');
    }

    public function down()
    {
        $this->forge->dropTable('dpa');
    }
}
