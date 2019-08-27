<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $batches = ['Batch-1', 'Batch-2'];
      foreach (range(1,20) as $index) {
          DB::table('batch')->insert([
            'name'       => $faker->randomElement($batches),
            'start_date' => $faker->date('Y-m-d', now()),
            'end_date'   => $faker->date('Y-m-d', strtotime('+3 Months')),
            'created_at' =>  now(),
            'updated_at' =>  now()
          ]);
        }
    }
}
