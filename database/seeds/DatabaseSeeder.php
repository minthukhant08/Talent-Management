<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(BatchTableSeeder::class);
      $this->call(CourseTableSeeder::class);
      $this->call(TopicTableSeeder::class);
      $this->call(UserTableSeeder::class);
      $this->call(TopicDetailTableSeeder::class);
      $this->call(ActivityTableSeeder::class);
      $this->call(CommentTableSeeder::class);
      $this->call(LikeTableSeeder::class);
      $this->call(AssignmentTableSeeder::class);
      $this->call(StudentAssignementTableSeeder::class);
      $this->call(IntakeTableSeeder::class);
      $this->call(NotificationTableSeeder::class);
      $this->call(ComfirmTableSeeder::class);
    }
}
