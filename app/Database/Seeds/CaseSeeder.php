<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 'S01',
                'case'    => 'Sukses Pickup AWB Belum Aktif',
            ],
            [
                'id' => 'S02',
                'case'    => 'Sukses Pickup AWB Belum Terbit',
            ],
            [
                'id' => 'S03',
                'case'    => 'Sukses Pickup',
            ],
            [
                'id' => 'C01',
                'case'    => 'Speed Up Pickup',
            ],
            [
                'id' => 'ST01',
                'case'    => 'Status Tidak Sesuai',
            ],
            [
                'id' => 'MP01',
                'case'    => 'Missed Pickup',
            ],
            [
                'id' => 'IN01',
                'case'    => 'Investigasi',
            ],
            [
                'id' => 'IN02',
                'case'    => 'Issue',
            ],
            [
                'id' => 'CS01',
                'case'    => 'Invalid',
            ],
            [
                'id' => 'CS02',
                'case'    => 'Request Pickup',
            ],
            [
                'id' => 'CS03',
                'case'    => 'System',
            ],

        ];
        // Using Query Builder
        $this->db->table('cases')->insertBatch($data);
    }  //
}
