<?php

namespace App\Http\Controllers;

use App;
use App\Models\Person;
use View;

class ShowPeopleList extends Controller
{
    public function __invoke()
    {
        $people = Person::query()
            ->orderBy(Person::ATTR_NAME)
            ->get();
        return View::make("pages/list-people", compact("people"));
    }
}
