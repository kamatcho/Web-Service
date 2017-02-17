<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TasksSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0 ; $i<20 ; $i ++ ) {
            $task = new  \App\Task();
            $task->user_id = 7;
            $task->task = $faker->title;
            $task->description = $faker->randomLetter;
            $task->save();
        }
    }
}
