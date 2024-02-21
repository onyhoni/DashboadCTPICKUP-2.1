<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'issue_id' => 1,
                'name' => 'Missed Pickup',
            ],
            [
                'issue_id' => 1,
                'name' => 'Late Pickup',
            ],
            [
                'issue_id' => 1,
                'name' => 'Late Entry',
            ],
            [
                'issue_id' => 1,
                'name' => 'Praposting Tidak sesuai',
            ],
            [
                'issue_id' => 1,
                'name' => 'Menunggu Pickup',
            ],
            [
                'issue_id' => 2,
                'name' => 'Invalid Cnnote',
            ],
            [
                'issue_id' => 2,
                'name' => 'Jaringan',
            ],
            [
                'issue_id' => 3,
                'name' => 'PC',
            ],
        ];

        $this->db->table('sub_types')->insertBatch($data);
    }
}
