<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AkunTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'kode_akun' => ['type' => 'VARCHAR', 'constraint' => 50],
            'uraian_akun' => ['type' => 'VARCHAR', 'constraint' => 100],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('akun');
    }

    public function down()
    {
        $this->forge->dropTable('akun');
    }
}
