<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubkegiatanTable extends Migration
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
            'id_kegiatan' => [
                'type' => 'INT', 'constraint' => 5, 'unsigned' => true
            ],
            'kode_subkegiatan' => [
                'type' => 'VARCHAR', 'constraint' => 50
            ],
            'nama_subkegiatan' => [
                'type' => 'VARCHAR', 'constraint' => 100
            ],
            'bidang' => [ 
                'type' => 'VARCHAR', 'constraint' => 100
            ],
            'kode_bidang' => [ 
                'type' => 'VARCHAR', 'constraint' => 50
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
        $this->forge->createTable('subkegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('subkegiatan');
    }
}
