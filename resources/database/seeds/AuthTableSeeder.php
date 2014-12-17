<?php
/**
 * Created by PhpStorm.
 * User: MacBookEr
 * Date: 12/16/14
 * Time: 6:56 PM
 */


use App\Auth\Auth as Auth;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuthTableSeeder extends Seeder{

    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,5) as $index)
        {
           Auth::create([

               'userId' => $index,

               'ipAddress' => $faker->ipv4,

               'publicToken' => $faker->creditCardNumber,

               'expireson' => $faker->dateTimeThisMonth,

               'hashSecret' => $faker->creditCardNumber


           ]);
        }


    }

}