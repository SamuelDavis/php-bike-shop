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

    public function showPerson(?string $personId = null)
    {
        $person = Person::query()->find($personId) ?: new Person;
        return View::make("pages/edit-person", compact("person"));
    }

    public function savePerson(EditPersonRequest $request, ?string $personId = null)
    {
        $person = Person::query()->find($personId) ?: new Person;
        $person
            ->fill($request->input())
            ->save();
        Flash::success("Person saved.");
        return Redirect::to("/person/{$person->id}");
    }
}
