<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataRekeningTable extends Migration
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
            'akun' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'objek' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'rincian_object' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'sub_rincian_objek' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'uraian_akun' => [
                'type' => 'LONGTEXT',
            ],
            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('data_rekening');
    }

    public function down()
    {
        $this->forge->dropTable('data_rekening');
    }
}
