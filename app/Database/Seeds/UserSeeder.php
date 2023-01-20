<?php

namespace App\Database\Seeds;

use Faker\Factory;
use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();

        $user->save([
            'username' => 'ABDUL HONI',
            'password'    => password_hash('password', PASSWORD_BCRYPT),
            'email' => 'abdulhoni19@gmail.com',
            'role'    => 'Admin',
        ]);

        $faker = Factory::create('id_ID');

        for ($i = 1; $i < 50; $i++) {
            $user->save([
                'username' => $faker->username,
                'password'    => password_hash('password', PASSWORD_BCRYPT),
                'email' => $faker->email,
                'role'    => 'Admin',
            ]);
        }
    }
}
