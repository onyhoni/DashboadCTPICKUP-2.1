<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateZipsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
            ],
            'regional' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'zona' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
            ],
            'sla' => [
                'type'       => 'INT',
                'constraint' => '2',
            ],
            'code_3lc' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cities');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
    }
}
