<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDescription extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sub_type_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'impact_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sub_type_id', 'sub_types', 'id');
        $this->forge->addForeignKey('impact_id', 'impacts', 'id');
        $this->forge->createTable('descriptions');
    }

    public function down()
    {
        $this->forge->dropTable('descriptions');
    }
}
