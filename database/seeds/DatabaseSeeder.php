<?php

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
        $this->call(PeopleSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(BikeSeeder::class);
        $this->call(BikeTodoSeeder::class);
    }
}
