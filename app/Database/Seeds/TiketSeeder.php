<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TiketSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i < 100; $i++) {
            $data = [
                [
                    'tiket_id' => $faker->uuid(),
                    'case_id'    => 'C01',
                    'desc'    => 'DIPASTIKAN TERPICKUP SEBELUM JAM 17',
                    'status'    => 'OPEN',
                    'urgency'    => 'VERY HIGH',
                    'awb' => '0151332203230374',
                    'no_order'    => 'MPDS-253569637-8731',
                    'pic_name'    => strtoupper($faker->name()),
                    'account'    => '80077901',
                    'origin'    => 'AMI10000',
                    'regional'    => 'JAKARTA',
                    'city'    => strtoupper($faker->city()),
                    'customer_name'    => 'ZALORA',
                    'seller_name'    => strtoupper($faker->name()),
                    'merchant_id'    => '',
                    'seller_address'    => strtoupper($faker->address()),
                    'seller_phone'    => strtoupper($faker->phoneNumber()),
                    'destinasi'    => '',
                    'service'    => '',
                    'intruksi'    => '',
                    'ins_value'    => '',
                    'cod_flag' => 'NON COD',
                    'cod_amount'    => '',
                    'armada'    => 'MOTOR',
                    'modul_entry'    => 'API',
                    'desc_good'    => 'APPAREL AND ACCESSORIES',
                    'qty'    => 1,
                    'weight'    => 1,
                    'city_id' => '15650',
                    'created_at'    => Time::now(),
                    'updated_at'    => NULL,
                    'deleted_at'    => NULL,
                    'closed_at'    => NULL,
                    'user_id' => 1
                ],

            ];
            // Using Query Builder
            $this->db->table('tikets')->insertBatch($data);
        }
    }
}
