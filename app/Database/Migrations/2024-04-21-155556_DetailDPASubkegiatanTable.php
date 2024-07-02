<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailDPASubkegiatanTable extends Migration
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
            // 'id_dpa' => [
            //     'type' => 'INT', 
            //     'constraint' => 5, 
            //     'unsigned' => true, 
            // ],
            'id_detail_dpa' => [
                'type' => 'INT', 
                'constraint' => 5, 
                'unsigned' => true, 
            ],
            'uraian' => [
                'type' => 'VARCHAR', 
                'constraint' => 255
            ],
            'koefisien' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'satuan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'harga' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'ppn' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'jumlah' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'keterangan' => [
                'type' => 'LONGTEXT', 
            ],
            'koefisien_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'satuan_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'harga_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'ppn_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'jumlah_perubahan' => [
                'type' => 'VARCHAR', 
                'constraint' => 20
            ],
            'keterangan_perubahan' => [
                'type' => 'LONGTEXT', 
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
        $this->forge->createTable('detail_dpa_subkegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('detail_dpa_subkegiatan');
    }
}
