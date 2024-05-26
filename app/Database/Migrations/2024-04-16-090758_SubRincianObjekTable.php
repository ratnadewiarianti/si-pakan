<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubRincianObjekTable extends Migration
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
            'id_rincian_objek' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'kode_sub_rincian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'uraian_sub_rincian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sub_rincian_objek');
    }

    public function down()
    {
        $this->forge->dropTable('sub_rincian_objek');
    }
}
