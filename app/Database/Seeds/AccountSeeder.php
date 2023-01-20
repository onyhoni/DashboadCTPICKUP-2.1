<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 80077901,
            'cust_grouping' => 'BANKING',
            'cust_industry' => 'ZALORA',
            'cust_branch' => 'NA',
            'payment_metode' => 'NON COD',
            'pic_name' => 'ONYHONI',
            'sales_name' => 'ONYHONI',
            'sales_phone' => '02195319600',
            'created_at' => Time::now(),
            'updated_at' => NULL,
            'deleted_at' => NULL,
        ];

        $this->db->table('accounts')->insert($data);
    }
}
