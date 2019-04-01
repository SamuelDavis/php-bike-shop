<?php

use App\Models\Bike;
use App\Models\Person;
use Faker\Generator;
use Illuminate\Database\Seeder;

class BikeSeeder extends Seeder
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
        $people = Person::query()->get()->all();

        for ($i = 0; $i < $this->faker->numberBetween(5, 10); $i++) {
            $this->faker->bike
                ->setRelations([
                    Bike::RELATION_SOURCE => $people[array_rand($people)],
                    Bike::RELATION_OWNER => $this->faker->boolean ? $people[array_rand($people)] : null,
                ])
                ->save();
        }
    }
}
