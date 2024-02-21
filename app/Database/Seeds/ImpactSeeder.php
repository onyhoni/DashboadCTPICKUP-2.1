<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ImpactSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Complaint Customer meningkat dan berpotensi Claim',
            ],
            [
                'name' => 'Over Sla Entry',
            ],
            [
                'name' => 'Missrouted',
            ],
            [
                'name' => 'pending rekonsiliasi invoice',
            ],
            [
                'name' => 'Late entry',
            ],
            [
                'name' => 'keterlambatan respon/proses kerja',
            ],
        ];

        $this->db->table('impacts')->insertBatch($data);
    }
}
