<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Course;
use App\Batch;

class UserTableSeeder extends Seeder
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
      $batches = Batch::all()->pluck('id')->toArray();
      $img = file_get_contents('public/images/fake.png');
        foreach (range(1,20) as $index) {
            DB::table('user')->insert([
              'name'          =>  $faker->name,
              'email'         =>  $faker->unique()->safeEmail,
              'date_of_birth' =>  $faker->date('Y-m-d', now()),
              'nrc_no'        =>  Str::random(10),
              'phone_no'      =>  $faker->e164PhoneNumber,
              'address'       =>  $faker->address,
              'image'         =>  'https://vuetifyjs.com/apple-touch-icon-180x180.png',
              'course_id'     =>  $faker->randomElement($courses),
              'batch_id'      =>  $faker->randomElement($batches),
              'type'          =>  $faker->numberBetween(0,3),
              'gender'        =>  $faker->numberBetween(0,1),
              'created_at'    =>  now(),
              'updated_at'    =>  now()
            ]);
          }
    }
}
