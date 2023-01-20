<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTiketsTable extends Migration
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
            'tiket_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'case_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'desc' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'urgency' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'awb' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'no_order' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pic_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'account' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'origin' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'regional' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => '125',
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'seller_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'merchant_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'seller_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'seller_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'destinasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'service' => [
                'type'       => 'VARCHAR',
                'constraint' => '7',
            ],
            'intruksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ins_value' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cod_flag' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cod_amount' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'armada' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'modul_entry' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'desc_good' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'qty' => [
                'type'       => 'int',
                'constraint'     => 11,
            ],
            'weight' => [
                'type'       => 'int',
                'constraint'     => 11,
            ],
            'city_id' => [
                'type'       => 'VARCHAR',
                'constraint'     => 11,
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
            'closed_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('city_id', 'cities', 'id');
        $this->forge->addForeignKey('case_id', 'cases', 'id');
        $this->forge->addForeignKey('account', 'accounts', 'id');
        $this->forge->createTable('tikets');
    }

    public function down()
    {
        $this->forge->dropTable('tikets');
    }
}
