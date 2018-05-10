<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
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

            \App\Order::create([
                'name'       =>  str_random(6),
                'price'     =>  random_int(100,200),
            ]);
        }
    }
}
