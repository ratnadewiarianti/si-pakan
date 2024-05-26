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
            'persen' => ['type' => 'VARCHAR', 'constraint' => 10],
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
        $this->forge->createTable('pajak');
    }

    public function down()
    {
        $this->forge->dropTable('pajak');
    }
}
