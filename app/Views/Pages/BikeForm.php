<?php

namespace App\Views\Pages;

use App\Http\Controllers\SaveBike;
use App\Http\Controllers\SaveBikeTodo;
use App\Http\Controllers\ShowBikeTodoForm;
use App\Models\Bike;
use App\Models\BikeTodo;
use App\Models\Person;
use App\Views\Traits\RendersAttributes;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use URL;
use function sprintf;

class BikeForm extends ViewModel
{
    use RendersAttributes;

    /** @var Bike */
    public $bike;
    /** @var Collection|Person[] */
    public $people;

    public function __construct(Bike $bike, Collection $people)
    {
        parent::__construct();
        $this->bike = $bike;
        $this->people = $people;
    }

    public function actionHref(): string
    {
        return URL::route(SaveBike::class, [
            "bike" => $this->bike,
        ]);
    }

    public function selectedSource(Person $person): string
    {
        return $this->renderSelectedAttribute($person->id === $this->bike->source_id);
    }

    public function selectedOwner(Person $person): string
    {
        return $this->renderSelectedAttribute($person->id === $this->bike->owner_id);
    }

    public function todoActionHref(): string
    {
        return URL::route(SaveBikeTodo::class, [
            "bike" => $this->bike,
        ]);
    }

    public function editTodoHref(BikeTodo $bikeTodo)
    {
        return URL::route(ShowBikeTodoForm::class, [
            "bike" => $this->bike,
            "bikeTodo" => $bikeTodo,
        ]);
    }

    public function todoByLine(BikeTodo $bikeTodo)
    {
        return sprintf(
            "(%s & %s on %s)",
            $bikeTodo->completedBy->name,
            $bikeTodo->confirmedBy->name,
            $bikeTodo->completed_at->toDateString()
        );
    }
}