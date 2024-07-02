<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailRakBelanja extends Migration
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
            'id_rakbelanja' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nilai' => [
                'type' => 'int',
                'constraint' => 10,
            ],
            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 4,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('detail_rakbelanja');
    }

    public function down()
    {
        $this->forge->dropTable('detail_rakbelanja');
    }
}
