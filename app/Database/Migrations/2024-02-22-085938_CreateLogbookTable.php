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
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'issue_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'sub_type_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'description_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'impact_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->addForeignKey('issue_id', 'issues', 'id');
        $this->forge->addForeignKey('sub_type_id', 'sub_types', 'id');
        $this->forge->addForeignKey('description_id', 'descriptions', 'id');
        $this->forge->addForeignKey('impact_id', 'impacts', 'id');
        $this->forge->createTable('logbooks');
    }

    public function down()
    {
        $this->forge->dropTable('logbooks');
    }
}
