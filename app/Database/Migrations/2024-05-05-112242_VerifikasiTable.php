<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VerifikasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'id_detail_penatausahaan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'nomor_bku' => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal' => ['type' => 'VARCHAR', 'constraint' => 30],
            'uraian' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nilai_spj' => ['type' => 'VARCHAR', 'constraint' => 30],
            'ppn' => ['type' => 'VARCHAR', 'constraint' => 30],
            'pph_psl_23' => ['type' => 'VARCHAR', 'constraint' => 30],
            'pph_psl_22' => ['type' => 'VARCHAR', 'constraint' => 30],
            'pph_psl_21' => ['type' => 'VARCHAR', 'constraint' => 30],
            'pajak_daerah' => ['type' => 'VARCHAR', 'constraint' => 30],
            'diterima' => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_spj' => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_kwitansi' => ['type' => 'VARCHAR', 'constraint' => 100],
            'status_bendahara' => ['type' => 'VARCHAR', 'constraint' => 10],
            'status_kasubbag' => ['type' => 'VARCHAR', 'constraint' => 10],
            'status_pptik' => ['type' => 'VARCHAR', 'constraint' => 10],
            'status_verifikator_keuangan' => ['type' => 'VARCHAR', 'constraint' => 10],
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('verifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('verifikasi');
    }
}