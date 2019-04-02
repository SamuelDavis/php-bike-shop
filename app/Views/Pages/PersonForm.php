<?php

namespace App\Views\Pages;

use App\Http\Controllers\SavePerson;
use App\Models\Person;
use App\Views\ViewModel;
use URL;

class PersonForm extends ViewModel
{
    /** @var Person */
    public $person;

    public function __construct(Person $person)
    {
        parent::__construct();
        $this->person = $person;
    }

    public function actionHref(): string
    {
        return URL::route(SavePerson::class, [
            "person" => $this->person,
        ]);
    }

    public function getDob(): ?string
    {
        return $this->person->dob ? $this->person->dob->format("Y-m-d") : null;
    }
}