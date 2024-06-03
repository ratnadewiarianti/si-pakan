<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KeteranganDPATable extends Migration
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
            'keperluan' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 50
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
           
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('keterangan_penatausahaan');
    }

    public function down()
    {
        $this->forge->createTable('keterangan_penatausahaan');
    }
}
