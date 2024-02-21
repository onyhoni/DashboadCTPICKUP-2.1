<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'People'
            ],
            [
                'name' => 'System'
            ],
            [
                'name' => 'Tools'
            ],
        ];
        $this->db->table('issues')->insertBatch($data);
    }
}
