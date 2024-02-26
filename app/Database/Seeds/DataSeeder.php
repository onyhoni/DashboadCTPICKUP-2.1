<?php

namespace App\Database\Seeds;

use App\Models\Updatelogbook;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class DataSeeder extends Seeder
{

    public function run()
    {
        $this->call('UserSeeder');
        $this->call('AccountSeeder');
        $this->call('CaseSeeder');
        $this->call('ZipSeeder');
        $this->call('TiketSeeder');
        $this->call('CategoriySeeder');
        $this->call('IssueSeeder');
        $this->call('SubTypeSeeder');
        $this->call('ImpactSeeder');
        $this->call('DescriptionSeeder');
        $this->call('LogBookSeeder');

        $faker = Factory::create('id_ID');
        $updatBooks = new Updatelogbook();

        for ($i = 1; $i < 50; $i++) {
            $updatBooks->save([
                'resolution' => $faker->paragraph(),
                'evidance' => $faker->paragraph(),
                'user_id' => rand(1, 9),
                'logbook_id' => rand(1, 100),
                'created_at' => Time::now()
            ]);
        }
    }
}
