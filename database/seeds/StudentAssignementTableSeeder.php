<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Assignment;

class StudentAssignementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $student = User::all()->where('type', '=', 1)->pluck('id')->toArray();
      $assignment = Assignment::all()->pluck('id')->toArray();
        foreach (range(1,20) as $index) {
            DB::table('student_assignment')->insert([
              'student_id'   => $faker->randomElement($student),
              'assignment_id'=> $faker->randomElement($assignment),
              'marks'        => $faker->numberBetween(1,100),
              'created_at'   =>  now(),
              'updated_at'   =>  now()
            ]);
          }
    }
}
