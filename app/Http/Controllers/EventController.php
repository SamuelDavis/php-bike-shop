<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\ListEventsRequest;
use App\Models\Event;
use Google_Service_Exception;
use Redirect;
use Spatie\GoogleCalendar\Event as GoogleEvent;
use View;
use function compact;

class EventController extends Controller
{
    public function listEvents(ListEventsRequest $request)
    {
        $events = Event::query()
            ->where(Event::ATTR_STARTS_AT, ">=", $request->from)
            ->where(Event::ATTR_ENDS_AT, "<", $request->to)
            ->get();
        return View::make("pages/list-events", compact("events"));
    }

    public function importGoogleEvents(ListEventsRequest $request)
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
        return Redirect::to($request->rewriteUrl([
            "from" => $request->from->toDateString(),
            "to" => $request->to->toDateString(),
        ]));
    }
}
