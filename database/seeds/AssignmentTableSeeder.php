<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class AssignmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $teacher = User::all()->where('type','=',1)->pluck('id')->toArray();
        foreach (range(1,20) as $index) {
            DB::table('assignment')->insert([
              'name'         => $faker->word,
              'teacher_id'   => $faker->randomElement($teacher),
              'created_at'   => now(),
              'updated_at'   => now()
            ]);
          }
    }
}
