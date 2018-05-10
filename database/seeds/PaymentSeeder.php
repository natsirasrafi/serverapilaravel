<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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

            //for ($a=1; $a<=10; $a++) {
                \App\Payment::create([
                    'value' => random_int(100, 200),
                    'time' => '2018-05-11 00:00:00',
                    'id_user' => $i,
                    'id_order' => $i,
                ]);
            //}
        }
    }
}
