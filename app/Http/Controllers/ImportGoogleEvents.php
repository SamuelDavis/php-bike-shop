<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\ListEventsRequest;
use App\Models\Event;
use Google_Service_Exception;
use Redirect;
use Spatie\GoogleCalendar\Event as GoogleEvent;

class ImportGoogleEvents extends Controller
{
    public function __invoke(ListEventsRequest $request)
    {
        try {
            $events = GoogleEvent::get($request->from, $request->to);
            $existingEvents = Event
                ::query()
                ->whereIn(Event::ATTR_ID, $events->map(function (GoogleEvent $event) {
                    return $event->id;
                }))
                ->get()
                ->keyBy(Event::ATTR_ID);
            $events->each((function (GoogleEvent $event) use ($existingEvents) {
                ($existingEvents[$event->id] ?? new Event)
                    ->fill([
                        Event::ATTR_ID => $event->id,
                        Event::ATTR_NAME => $event->name,
                        Event::ATTR_DESCRIPTION => $event->description,
                        Event::ATTR_ADDRESS => $event->location,
                        Event::ATTR_STARTS_AT => $event->startDateTime,
                        Event::ATTR_ENDS_AT => $event->endDateTime,
                    ])
                    ->save();
            }));
        } catch (Google_Service_Exception $e) {
            if ($e->getCode() === 404) {
                App::abort(404, "Google Calendar not Found");
            }
        }
        return Redirect::route(ShowEventsList::class, [
            "from" => $request->from->toDateString(),
            "to" => $request->to->toDateString(),
        ]);
    }
}
