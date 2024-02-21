<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogbookTable extends Migration
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
            'account_id' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'code_3lc' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'regional' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'priority' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'issue' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'sub_type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'impact' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'escalation' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => 'OPEN'
            ],
            'action' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'task' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('account_id', 'accounts', 'id');
        $this->forge->createTable('logbooks');
    }

    public function down()
    {
        $this->forge->dropTable('logbooks');
    }
}
