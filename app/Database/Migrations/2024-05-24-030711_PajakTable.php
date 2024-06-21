<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PajakTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_pajak' => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_pajak' => ['type' => 'VARCHAR', 'constraint' => 50],
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
        $this->forge->createTable('pajak');
    }

    public function down()
    {
        $this->forge->dropTable('pajak');
    }
}
