<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;
use App\Views\Pages\BikeTodoForm;

class ShowBikeTodoForm extends Controller
{
    public function __invoke(Bike $bike, BikeTodo $bikeTodo = null)
    {
        $bikeTodo = $bikeTodo ?: new BikeTodo;
        $bikeTodo->setRelation(BikeTodo::RELATION_BIKE, $bike);
        $people = Person::query()->get();
        return new BikeTodoForm($bikeTodo, $people);
    }
}
