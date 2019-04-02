<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\EditPersonRequest;
use App\Models\Person;
use Flash;
use Redirect;
use View;

class PersonController extends Controller
{
    public function listPeople()
    {
        $people = Person::query()
            ->orderBy(Person::ATTR_NAME)
            ->get();
        return View::make("pages/list-people", compact("people"));
    }

    public function showPerson(Person $person = null)
    {
        $person = $person ?: new Person;
        return View::make("pages/edit-person", compact("person"));
    }

    public function savePerson(EditPersonRequest $request, Person $person = null)
    {
        $person = $person ?: new Person;
        $person
            ->fill($request->input())
            ->save();
        Flash::success("Person saved.");
        return Redirect::to("/person/{$person->id}");
    }
}
