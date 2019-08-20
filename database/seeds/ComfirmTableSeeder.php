<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class ComfirmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $user = User::all()->pluck('id')->toArray();
      foreach (range(1,20) as $index) {
          DB::table('comfirm')->insert([
            'user_id'      => $faker->randomElement($user),
            'created_at'   => now(),
            'updated_at'   => now()
          ]);
        }
    }
}
