<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Activity;
use App\User;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $users = User::all()->pluck('id')->toArray();
      $activities = Activity::all()->pluck('id')->toArray();
        foreach (range(1,20) as $index) {
            DB::table('like')->insert([
              'user_id' => $faker->randomElement($users),
              'activity_id' =>$faker->randomElement($activities),
              'created_at'  =>  now(),
              'updated_at'  =>  now()
            ]);
          }
    }
}
