<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\ListEventsRequest;
use App\Models\Event;
use View;
use function compact;

class ShowEventsList extends Controller
{
    public function __invoke(ListEventsRequest $request)
    {
        $events = Event::query()
            ->where(Event::ATTR_STARTS_AT, ">=", $request->from)
            ->where(Event::ATTR_ENDS_AT, "<", $request->to)
            ->get();
        return View::make("pages/list-events", compact("events"));
    }
}
