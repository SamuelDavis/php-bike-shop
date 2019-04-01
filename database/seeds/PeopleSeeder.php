<?php

use App\Models\Person;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < $this->faker->numberBetween(5, 10); $i++) {
            /** @var Person $person */
            $person = $this->faker->person;
            $person->save();
        }
    }
}
