<?php

use Faker\Generator;

class Seeder extends \Illuminate\Database\Seeder
{
    protected $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }
}