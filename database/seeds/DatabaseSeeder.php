<?php

use App\Models\Attendance;
use Faker\Generator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $people = [];
        $events = [];
        $attendance = [];

        for ($i = 0; $i < 10; $i++) {
            $people[] = $this->faker->person->save();
        }

        for ($i = 0; $i < 3; $i++) {
            $events[] = $this->faker->event->save();
        }

        for ($i = 0; $i < 10; $i++) {
            $attendance[] = $this->faker->attendance
                ->setRelation(Attendance::RELATION_EVENT, $events[array_rand($events)])
                ->setRelation(Attendance::RELATION_PERSON, $people[array_rand($people)])
                ->save();
        }

        // $this->call(UsersTableSeeder::class);
    }
}
