<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Topic;
use App\User;

class TopicDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $topic = Topic::all()->pluck('id')->toArray();
      $teacher = User::all()->where('type','=',1)->pluck('id')->toArray();
        foreach (range(1,20) as $index) {
            DB::table('topic_detail')->insert([
              'name'          =>  $faker->name,
              'descriptions'   =>  $faker->sentence,
              'date'          =>  $faker->date('Y-m-d', now()),
              'topic_id'      =>  $faker->randomElement($topic),
              'teacher_id'    =>  $faker->randomElement($teacher),
              'created_at'    =>  now(),
              'updated_at'    =>  now()
            ]);
          }
    }
}
