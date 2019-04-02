<?php

use App\Models\Event;
use Illuminate\Support\Carbon;

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
            $from = Carbon::now()->subMinutes($this->faker->numberBetween(0, 60 * 24));
            $to = $from->copy()->addMinutes($this->faker->numberBetween(0, 15 * 6));
            /** @var Event $event */
            $event = $this->faker->event;
            $event
                ->fill([
                    Event::ATTR_STARTS_AT => $from,
                    Event::ATTR_ENDS_AT => $to,
                ])
                ->save();
        }
    }
}
