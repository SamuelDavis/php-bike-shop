<?php

namespace App\Views\Pages;

use App\Http\Controllers\SaveBikeTodo;
use App\Models\BikeTodo;
use App\Models\Person;
use App\Views\Traits\RendersAttributes;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use URL;

class BikeTodoForm extends ViewModel
{
    use RendersAttributes;

    /** @var BikeTodo */
    public $bikeTodo;
    /** @var Collection|Person[] */
    public $people;

    public function __construct(BikeTodo $bikeTodo, Collection $people)
    {
        parent::__construct();
        $this->bikeTodo = $bikeTodo;
        $this->people = $people;
    }

    public function actionHref(): string
    {
        return URL::route(SaveBikeTodo::class, [
            "bike" => $this->bikeTodo->bike,
            "bikeTodo" => $this->bikeTodo,
        ]);
    }

    public function selectedCompletedBy(Person $person): string
    {
        return $this->renderSelectedAttribute($person->id === $this->bikeTodo->completed_by_id);
    }

    public function selectedConfirmedBy(Person $person): string
    {
        return $this->renderSelectedAttribute($person->id === $this->bikeTodo->confirmed_by_id);
    }
}