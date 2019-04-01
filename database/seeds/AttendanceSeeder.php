<?php

use App\Models\Attendance;
use App\Models\Person;
use Spatie\GoogleCalendar\Event;

class AttendanceSeeder extends Seeder
{
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
            /** @var Attendance $attendance */
            $attendance = $this->faker->attendance;
            $attendance
                ->setRelations([
                    Attendance::RELATION_EVENT => $events[array_rand($events)],
                    Attendance::RELATION_PERSON => $people[array_rand($people)],
                ])
                ->save();
        }
    }
}
