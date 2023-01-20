<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ZipSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '12000',
                'regional' => 'JAKARTA',
                'zona' => 'A',
                'sla'    => '3',
                'code_3lc'    => 'CGK',
            ],
            [
                'id' => '80000',
                'regional' => 'JTBNN',
                'zona' => 'B',
                'sla'    => '3',
                'code_3lc'    => 'AMI',
            ],
            [
                'id' => '17650',
                'regional' => 'BDTCC',
                'zona' => 'D',
                'sla'    => '5',
                'code_3lc'    => 'BKI',
            ],
            [
                'id' => '15650',
                'regional' => 'BDTCC',
                'zona' => 'D',
                'sla'    => '5',
                'code_3lc'    => 'TGR',
            ],

        ];
        // Using Query Builder
        $this->db->table('cities')->insertBatch($data);
    }  //
}
