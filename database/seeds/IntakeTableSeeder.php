<?php

use Illuminate\Database\Seeder;

class IntakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (range(1,20) as $index) {
          DB::table('intake')->insert([
            'available'   =>  1,
            'form_link'   =>  'http://docs.astrosubs.com/#/',
            'created_at'  =>  now(),
            'updated_at'  =>  now()
          ]);
        }
    }
}
