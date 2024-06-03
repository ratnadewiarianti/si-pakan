<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kelompok' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'kode_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'uraian_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('jenis');
    }

    public function down()
    {
        $this->forge->dropTable('jenis');
    }
}
