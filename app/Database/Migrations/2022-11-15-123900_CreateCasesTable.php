<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCasesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '125',
            ],
            'case' => [
                'type'       => 'VARCHAR',
                'constraint' => '125',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cases');
    }

    public function down()
    {
        $this->forge->dropTable('cases');
    }
}
