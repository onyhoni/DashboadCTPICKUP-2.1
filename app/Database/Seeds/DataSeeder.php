<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('AccountSeeder');
        $this->call('CaseSeeder');
        $this->call('ZipSeeder');
        $this->call('TiketSeeder');
    }
}
