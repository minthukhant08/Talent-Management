<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Activity;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
     $activities = Activity::all()->pluck('id')->toArray();
     $users = User::all()->pluck('id')->toArray();
       foreach (range(1,20) as $index) {
           DB::table('notification')->insert([
             'user_id'     => $faker->randomElement($users),
             'type'        => $faker->numberBetween(0,2),
             'title'       => $faker->word,
             'descriptions' => $faker->sentence,
             'date'        => $faker->date('Y-m-d', now()),
             'created_at'  => now(),
             'updated_at'  => now()
           ]);
         }
    }
}
