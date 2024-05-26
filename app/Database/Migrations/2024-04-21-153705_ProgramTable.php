<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgramTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_bidang_urusan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'kode_program' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama_program' => ['type' => 'VARCHAR', 'constraint' => 100],
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
        $this->forge->createTable('program');
    }

    public function down()
    {
        $this->forge->dropTable('program');
    }
}
