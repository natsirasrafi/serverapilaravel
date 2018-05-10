<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,10) as $i){
            \App\User::create([
               'name'       =>  $faker->name,
                'email'     =>  $faker->email,
                'password'  =>  bcrypt(str_random(6)),
                'remember_token'    => str_random(10),
            ]);
        }
    }
}
