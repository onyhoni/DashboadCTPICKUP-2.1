<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DescriptionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sub_type_id' => 1,
                'impact_id' => 1,
                'name' => 'Petugas tidak datang'
            ],
            [
                'sub_type_id' => 2,
                'impact_id' => 1,
                'name' => 'Petugas pickup overload/lebih muatan'
            ],
            [
                'sub_type_id' => 2,
                'impact_id' => 1,
                'name' => 'Petugas datang setelah Jam ops seller tutup'
            ],
            [
                'sub_type_id' => 2,
                'impact_id' => 1,
                'name' => 'Status Address Closed Kemalaman'
            ],
            [
                'sub_type_id' => 3,
                'impact_id' => 2,
                'name' => 'Menunggu intruksi dari customer'
            ],
            [
                'sub_type_id' => 3,
                'impact_id' => 2,
                'name' => 'Overload WH'
            ],
            [
                'sub_type_id' => 4,
                'impact_id' => 3,
                'name' => 'Input di system tidak sesuai intruksi'
            ],
            [
                'sub_type_id' => 5,
                'impact_id' => 1,
                'name' => 'Percepatan proses pickup'
            ],
            [
                'sub_type_id' => 6,
                'impact_id' => 5,
                'name' => 'Cancel by marketplace'
            ],
            [
                'sub_type_id' => 6,
                'impact_id' => 5,
                'name' => 'Non Cover COD'
            ],
            [
                'sub_type_id' => 6,
                'impact_id' => 5,
                'name' => 'Non Cover JTR'
            ],
            [
                'sub_type_id' => 6,
                'impact_id' => 5,
                'name' => 'Repush API'
            ],
            [
                'sub_type_id' => 7,
                'impact_id' => 6,
                'name' => 'Apex Eror'
            ],
            [
                'sub_type_id' => 7,
                'impact_id' => 6,
                'name' => 'Dashboard error'
            ],
            [
                'sub_type_id' => 8,
                'impact_id' => 6,
                'name' => 'PC ERROR'
            ],
        ];

        $this->db->table('descriptions')->insertBatch($data);
    }
}
