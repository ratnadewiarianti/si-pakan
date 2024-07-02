<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailDPATable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'id_dpa' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'id_subkegiatan' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'id_rekening' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'jumlah' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'jumlah_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 50
            ],
            'tahun' => [
                'type' => 'VARCHAR', 
                'constraint' => 4
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('detail_dpa');
    }

    public function down()
    {
        $this->forge->dropTable('detail_dpa');
    }
}
