<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Detail2Penatausahaan extends Migration
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
            'id_detail_penatausahaan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_karyawan' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'nominal' => [
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
        $this->forge->createTable('detail2_penatausahaan');
    }

    public function down()
    {
        $this->forge->dropTable('detail2_penatausahaan');
    }
}
