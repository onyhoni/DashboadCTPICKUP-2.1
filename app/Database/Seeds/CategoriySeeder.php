<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Internal'
            ],
            [
                'name' => 'External'
            ],


        ];
        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
