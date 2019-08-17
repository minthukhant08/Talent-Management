<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Course;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $courses = Course::all()->pluck('id')->toArray();
        foreach (range(1,20) as $index) {
            DB::table('topic')->insert([
              'course_id' => $faker->randomElement($courses),
              'topic' => $faker->word,
              'descriptions' => $faker->paragraph,
              'start_date' => $faker->date('Y-m-d', now()),
              'end_date' => $faker->date('Y-m-d', strtotime('+1 Days')),
              'created_at'  =>  now(),
              'updated_at'  =>  now()
            ]);
          }
    }
}
