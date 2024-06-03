<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ObjekTable extends Migration
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
            'id_jenis' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'kode_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'uraian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('objek');
    }

    public function down()
    {
        $this->forge->dropTable('objek');
    }
}
