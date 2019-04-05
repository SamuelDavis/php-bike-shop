<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\ListEventsRequest;
use App\Models\Event;
use App\Views\Components\EventList;
use App\Views\Pages\Container;
use URL;
use function compact;

class ShowEventsList extends Controller
{
    public function __invoke(ListEventsRequest $request)
    {
        $events = Event::query()
            ->where(Event::ATTR_STARTS_AT, ">=", $request->from)
            ->where(Event::ATTR_ENDS_AT, "<", $request->to)
            ->get();
        $eventList = new EventList($events, function (Event $event) {
            return URL::route(ShowAttendanceList::class, compact("event"));
        });
        return new Container($eventList);
    }
}
