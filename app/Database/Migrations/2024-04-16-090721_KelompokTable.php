<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelompokTable extends Migration
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
            'id_akun' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'kode_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'uraian_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kelompok');
    }

    public function down()
    {
        $this->forge->dropTable('kelompok');
    }
}
