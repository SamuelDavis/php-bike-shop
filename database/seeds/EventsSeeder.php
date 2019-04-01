<?php

use App\Models\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < $this->faker->numberBetween(2, 5); $i++) {
            /** @var Event $event */
            $event = $this->faker->event;
            $event->save();
        }
    }
}
