<?php

namespace App\Http\Controllers;

use App;
use App\Models\Event;
use Google_Service_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Redirect;
use Spatie\GoogleCalendar\Event as GoogleEvent;
use View;
use function compact;
use function http_build_query;

class EventController extends Controller
{
    public function listEvents(Request $request)
    {
        $from = Carbon::parse($request->from ?: Carbon::now())->startOfDay();
        $to = Carbon::parse($request->to ?: Carbon::now())->endOfDay();
        $events = Event::query()
            ->where(Event::ATTR_STARTS_AT, ">=", $from)
            ->where(Event::ATTR_ENDS_AT, "<", $to)
            ->get();
        return View::make("pages/list-events", compact("events"));
    }

    public function importGoogleEvents(Request $request)
    {
        $from = Carbon::parse($request->from ?: Carbon::now())->startOfDay();
        $to = Carbon::parse($request->to ?: Carbon::now())->endOfDay();
        try {
            $events = GoogleEvent::get($from, $to);
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
        return Redirect::to("/?" . http_build_query([
                "from" => $from->toDateString(),
                "to" => $to->toDateString(),
            ]));
    }
}
