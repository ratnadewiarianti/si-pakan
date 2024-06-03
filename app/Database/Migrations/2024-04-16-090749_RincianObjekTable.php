<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RincianObjekTable extends Migration
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
            'id_objek' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'kode_rincian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'uraian_rincian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rincian_objek');
    }

    public function down()
    {
        $this->forge->dropTable('rincian_objek');
    }
}
