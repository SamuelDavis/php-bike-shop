<?php

use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;

class BikeTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Bike[] $bikes */
        $bikes = Bike::query()->get()->all();
        $people = Person::query()->get()->all();

        foreach ($bikes as $bike) {
            for ($i = 0; $i < $this->faker->numberBetween(0, 4); $i++) {
                /** @var BikeTodo $todo */
                $todo = $this->faker->bikeTodo;
                $todo
                    ->setRelations([
                        BikeTodo::RELATION_BIKE => $bike,
                        BikeTodo::RELATION_COMPLETED_BY => $todo->completedBy === null ? null : $people[array_rand($people)],
                        BikeTodo::RELATION_CONFIRMED_BY => $todo->confirmedBy === null ? null : $people[array_rand($people)],
                    ])
                    ->save();
            }
        }
    }
}
