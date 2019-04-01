<?php

namespace App\Http\Controllers;

use App;
use Google_Service_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\GoogleCalendar\Event;
use View;

class EventController extends Controller
{

    public function listEvents(Request $request)
    {
        $from = Carbon::parse($request->from ?: Carbon::now());
        $to = Carbon::parse($request->to ?: Carbon::now());
        try {
            $events = Event::get($from->startOfDay(), $to->endOfDay());
        } catch (Google_Service_Exception $e) {
            if ($e->getCode() === 404) {
                App::abort(404, "Google Calendar not Found");
            }
        }
        return View::make("pages/list-events", compact("events"));
    }
}
