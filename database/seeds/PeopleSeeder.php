<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
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
        for ($i = 0; $i < $this->faker->numberBetween(5, 10); $i++) {
            $this->faker->person->save();
        }
    }
}
