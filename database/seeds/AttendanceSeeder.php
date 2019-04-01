<?php

use App\Models\Attendance;
use App\Models\Person;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Spatie\GoogleCalendar\Event;

class AttendanceSeeder extends Seeder
{
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::get()->all();
        $people = Person::query()->get()->all();

        for ($i = 0; $i < $this->faker->numberBetween(5, 10); $i++) {
            $this->faker->attendance
                ->setRelations([
                    Attendance::RELATION_EVENT => $events[array_rand($events)],
                    Attendance::RELATION_PERSON => $people[array_rand($people)],
                ])
                ->save();
        }
    }
}
