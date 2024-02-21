<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSubType extends Migration
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
            'issue_id' => [
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
        $this->forge->addForeignKey('issue_id', 'issues', 'id');
        $this->forge->createTable('sub_types');
    }

    public function down()
    {
        $this->forge->dropTable('sub_types');
    }
}
