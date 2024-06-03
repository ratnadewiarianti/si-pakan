<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UrusanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'kode_urusan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama_urusan' => ['type' => 'VARCHAR', 'constraint' => 100],
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
        $this->forge->createTable('urusan');
    }

    public function down()
    {
        $this->forge->dropTable('urusan');
    }
}
