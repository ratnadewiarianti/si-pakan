<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenatausahaanTable extends Migration
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
            'link_google' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'karyawan_1' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'karyawan_2' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'karyawan_3' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('penatausahaan');
    }

    public function down()
    {
        $this->forge->dropTable('penatausahaan');
    }
}
