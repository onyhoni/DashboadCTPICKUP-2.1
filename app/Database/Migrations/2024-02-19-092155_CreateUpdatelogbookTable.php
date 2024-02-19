<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUpdatelogbookTable extends Migration
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
            'final_description' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'evidance' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'logbook_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'           => 'datetime',
            ],
            'updated_at' => [
                'type'           => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('updatelogbooks');
    }

    public function down()
    {
        $this->forge->dropTable('updatelogbooks');
    }
}
