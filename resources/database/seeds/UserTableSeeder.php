<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/15/14
 * Time: 10:36 AM
 */

//namespace Resources\Database\Seeds;

use App\UserDirectory\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,5) as $index)
        {
            User::create([

                'email' => $faker->email,

                'password' => password_hash('testtest', PASSWORD_DEFAULT)
            ]);
        }
    }
}