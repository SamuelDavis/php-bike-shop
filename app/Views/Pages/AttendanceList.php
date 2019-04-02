<?php

namespace App\Views\Pages;

use App\Models\Event;
use App\Models\Person;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class AttendanceList extends ViewModel
{
    /** @var Event */
    public $event;
    /** @var EloquentCollection|Person[] */
    public $people;
    /** @var Collection|int[] */
    private $attendance;

    public function __construct(Event $event, EloquentCollection $people, Collection $attendance)
    {
        parent::__construct();
        $this->event = $event;
        $this->people = $people;
        $this->attendance = $attendance;
    }

    public function isActive(Person $person): bool
    {
        return $this->attendance->contains($person->id);
    }
}