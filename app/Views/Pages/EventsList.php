<?php

namespace App\Views\Pages;

use App\Models\Event;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;

class EventsList extends ViewModel
{
    /** @var Collection|Event[] */
    public $events;

    public function __construct(Collection $events)
    {
        parent::__construct();
        $this->events = $events;
    }
}