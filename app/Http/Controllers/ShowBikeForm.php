<?php

namespace App\Http\Controllers;

use App;
use App\Models\Bike;
use App\Models\Person;
use App\Views\Pages\BikeForm;

class ShowBikeForm extends Controller
{
    public function __invoke(Bike $bike = null)
    {
        $bike = $bike ?: new Bike;
        $people = Person::query()->get();
        return new BikeForm($bike, $people);
    }
}
