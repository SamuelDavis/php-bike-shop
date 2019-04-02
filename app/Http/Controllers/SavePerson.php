<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\SavePersonRequest;
use App\Models\Person;
use Flash;
use Redirect;

class SavePerson extends Controller
{
    public function __invoke(SavePersonRequest $request, Person $person = null)
    {
        $person = $person ?: new Person;
        $person
            ->fill($request->input())
            ->save();
        Flash::success("Person saved.");
        return Redirect::route(ShowPersonForm::class, [
            "person" => $person->id,
        ]);
    }
}
