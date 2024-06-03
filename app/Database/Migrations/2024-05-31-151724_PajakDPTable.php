<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PajakDPTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_dp' => ['type' => 'INT', 'constraint' => 5],
            'id_pajak' => ['type' => 'INT', 'constraint' => 5],
            'tahun' => [
                'type' => 'YEAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pajak_dp');
    }

    public function down()
    {
        $this->forge->dropTable('pajak_dp');
    }
}
