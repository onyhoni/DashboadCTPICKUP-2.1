<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'cust_grouping' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cust_industry' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cust_branch' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'payment_metode' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'pic_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sales_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sales_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('accounts');
    }

    public function down()
    {
        $this->forge->dropTable('accounts');
    }
}
