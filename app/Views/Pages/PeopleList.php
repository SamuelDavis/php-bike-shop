<?php

namespace App\Views\Pages;

use App\Http\Controllers\ShowPersonForm;
use App\Models\Person;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use URL;
use function compact;

class PeopleList extends ViewModel
{
    /** @var Collection|Person[] */
    public $people;

    public function __construct(Collection $people)
    {
        parent::__construct();
        $this->people = $people;
    }

    public function personFormHref(Person $person = null): string
    {
        return URL::route(ShowPersonForm::class, compact("person"));
    }
}