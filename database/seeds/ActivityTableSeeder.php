<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $img = file_get_contents('public/images/fake.png');
        foreach (range(1,20) as $index) {
            DB::table('activity')->insert([
              'name'         => $faker->word,
              'image'        =>  base64_encode($img),
              'date'         => $faker->date('Y-m-d', now()),
              'descriptions' => $faker->paragraph,
              'speaker_name' => $faker->name,
              'type'         => $faker->numberBetween(0,1),
              'created_at'   =>  now(),
              'updated_at'   =>  now()
            ]);
          }
    }
}
