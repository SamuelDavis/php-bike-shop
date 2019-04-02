<?php

namespace App\Http\Controllers;

use App;
use App\Models\Person;
use App\Views\Pages\PeopleList;

class ShowPeopleList extends Controller
{
    public function __invoke()
    {
        $people = Person::query()
            ->orderBy(Person::ATTR_NAME)
            ->get();
        return new PeopleList($people);
    }
}
