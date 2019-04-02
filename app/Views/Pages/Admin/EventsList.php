<?php

namespace App\Views\Pages\Admin;

use App\Http\Controllers\ShowAttendanceList;
use App\Models\Event;
use App\Views\ViewModel;
use Illuminate\Database\Eloquent\Collection;
use URL;

class EventsList extends ViewModel
{
    /** @var Collection|Event[] */
    public $events;

    public function __construct(Collection $events)
    {
        parent::__construct();
        $this->events = $events;
    }

    public function eventHref(Event $event): string
    {
        return URL::route(ShowAttendanceList::class, compact("event"));
    }
}