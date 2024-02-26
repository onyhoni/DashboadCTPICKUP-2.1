<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LogBookSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i < 100; $i++) {
            $data = [
                [
                    'account_id' => '80077901',
                    'code_3lc' => 'CGK',
                    'regional' => 'JAKARTA',
                    'priority' => 'HIGH',
                    'category_id' => rand(1, 2),
                    'issue_id' => rand(1, 2),
                    'sub_type_id' => rand(1, 3),
                    'description_id' => rand(1, 3),
                    'impact_id' => rand(1, 3),
                    'escalation' => $faker->paragraph(),
                    'action' => $faker->paragraph(),
                    'task' => $faker->paragraph(),
                    'user_id' => rand(1, 10),
                    'created_at' => Time::now()

                ],

            ];
            $this->db->table('logbooks')->insertBatch($data);
        }
        // Using Query Builder

    }
}
