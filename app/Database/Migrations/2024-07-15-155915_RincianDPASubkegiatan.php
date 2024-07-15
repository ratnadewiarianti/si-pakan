<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RincianDPASubkegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_dp' => ['type' => 'INT', 'constraint' => 5],
            'id_detail_dpa_subkegiatan' => ['type' => 'INT', 'constraint' => 5],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rincian_dpa_subkegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('rincian_dpa_subkegiatan');
    }
}
