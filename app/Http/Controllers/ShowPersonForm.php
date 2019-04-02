<?php

namespace App\Http\Controllers;

use App;
use App\Models\Person;
use View;

class ShowPersonForm extends Controller
{
    public function __invoke(Person $person = null)
    {
        $person = $person ?: new Person;
        return View::make("pages/edit-person", compact("person"));
    }
}
