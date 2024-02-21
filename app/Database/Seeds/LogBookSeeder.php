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
                    'category' => 'INTERNAL',
                    'issue' => $faker->paragraph(),
                    'sub_type' => $faker->paragraph(),
                    'description' => $faker->paragraph(),
                    'impact' => $faker->paragraph(),
                    'escalation' => $faker->paragraph(),
                    'action' => $faker->paragraph(),
                    'task' => $faker->word(),
                    'user_id' => 1,
                    'created_at' => Time::now(),

                ],

            ];
            $this->db->table('logbooks')->insertBatch($data);
        }
        // Using Query Builder

    }
}
