<?php

namespace App\Http\Controllers;

use App;
use App\Models\Person;
use App\Views\Pages\PersonForm;

class ShowPersonForm extends Controller
{
    public function __invoke(Person $person = null)
    {
        $person = $person ?: new Person;
        return new PersonForm($person);
    }
}
