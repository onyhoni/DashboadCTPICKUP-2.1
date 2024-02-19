<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IsRead extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'message_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'read' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('message_id', 'messages', 'id');
        $this->forge->createTable('is_reads');
    }

    public function down()
    {
        $this->forge->dropTable('is_reads');
    }
}
