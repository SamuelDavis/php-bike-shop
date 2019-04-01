<?php

use App\Models\Bike;
use App\Models\Person;

class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = Person::query()->get()->all();

        for ($i = 0; $i < $this->faker->numberBetween(5, 10); $i++) {
            /** @var Bike $bike */
            $bike = $this->faker->bike;
            $bike
                ->setRelations([
                    Bike::RELATION_SOURCE => $people[array_rand($people)],
                    Bike::RELATION_OWNER => $this->faker->boolean ? $people[array_rand($people)] : null,
                ])
                ->save();
        }
    }
}
