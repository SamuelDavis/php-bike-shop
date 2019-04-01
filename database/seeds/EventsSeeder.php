<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
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
        for ($i = 0; $i < $this->faker->numberBetween(2, 5); $i++) {
            $this->faker->event->save();
        }
    }
}
