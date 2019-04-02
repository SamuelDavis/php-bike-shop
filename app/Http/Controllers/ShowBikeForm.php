<?php

namespace App\Http\Controllers;

use App;
use App\Models\Bike;
use App\Models\Person;
use View;

class ShowBikeForm extends Controller
{
    public function __invoke(Bike $bike = null)
    {
        $bike = $bike ?: new Bike;
        $people = Person::query()->get();
        return View::make("pages/edit-bike", compact("bike", "people"));
    }
}
