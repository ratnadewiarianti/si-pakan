<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RakBelanja extends Migration
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
            'nm_subkegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'id_detail_dpa' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true
            ],
            'nilai_rincian' => [
                'type' => 'int',
                'constraint' => 10,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rak_belanja');
    }

    public function down()
    {
        $this->forge->dropTable('rak_belanja');
    }
}
