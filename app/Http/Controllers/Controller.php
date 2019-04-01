<?php

namespace App\Http\Controllers;

use App;
use App\Builders\Builder;
use App\Models\Attendance;
use App\Models\Bike;
use App\Models\Person;
use Google_Service_Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Redirect;
use Spatie\GoogleCalendar\Event;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function toRoute(string $method = "__invoke")
    {
        return [
            "as" => static::class . "@{$method}",
            "uses" => static::class . "@{$method}"
        ];
    }

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

    public function showAttendance(?string $eventId = null)
    {
        $event = $this->lookupEvent($eventId);
        $attendance = Attendance::query()
            ->where(Attendance::ATTR_EVENT_ID, $eventId)
            ->whereNull(Attendance::ATTR_SIGNED_OUT_AT)
            ->pluck(Attendance::ATTR_PERSON_ID)
            ->unique();
        $people = Person::query()
            ->orderBy(Person::ATTR_NAME)
            ->get()
            ->sortByDesc(function (Person $person) use ($attendance) {
                return $attendance->contains($person->id);
            });
        return View::make("pages/attendance", compact("event", "attendance", "people"));
    }

    private function lookupEvent(string $eventId)
    {
        try {
            return Event::find($eventId);
        } catch (Google_Service_Exception $e) {
            if ($e->getCode() === 404) {
                App::abort(404, "Event not found.");
            }
            throw $e;
        }
    }

    public function toggleAttendance(string $eventId, string $personId)
    {
        $event = $this->lookupEvent($eventId);
        $person = Person::query()->findOrFail($personId);
        /** @var Attendance $existing */
        $existing = Attendance
            ::query()
            ->where(Attendance::ATTR_EVENT_ID, $event->id)
            ->where(Attendance::ATTR_PERSON_ID, $person->id)
            ->where(function (Builder $builder) {
                return $builder
                    ->whereNull(Attendance::ATTR_SIGNED_OUT_AT)
                    ->orWhere(Attendance::ATTR_SIGNED_OUT_AT, ">", Carbon::now()->subMinutes(15));
            })
            ->first();

        if ($existing) {
            $signedOutAt = $existing->signed_out_at === null ? Carbon::now() : null;
            $existing->setAttribute(Attendance::ATTR_SIGNED_OUT_AT, $signedOutAt)->save();
        } else {
            Attendance::query()
                ->make([
                    Attendance::ATTR_SIGNED_IN_AT => Carbon::now(),
                ])
                ->setRelations([
                    Attendance::RELATION_EVENT => $event,
                    Attendance::RELATION_PERSON => $person
                ])
                ->save();
        }
        return Redirect::to("/event/{$event->id}");
    }

    public function listPeople()
    {
        $people = Person::query()
            ->orderBy(Person::ATTR_NAME)
            ->get();
        return View::make("pages/list-people", compact("people"));
    }

    public function showPerson(?string $personId = null)
    {
        $person = Person::query()->find($personId) ?: new Person;
        return View::make("pages/edit-person", compact("person"));
    }

    public function savePerson(Request $request, ?string $personId = null)
    {
        $person = Person::query()->find($personId) ?: new Person;
        $person
            ->fill($request->input())
            ->save();
        return Redirect::to("/person/{$person->id}");
    }

    public function listBikes()
    {
        $bikes = Bike::query()->get();
        return View::make("pages/list-bikes", compact("bikes"));
    }

    public function showBike(?string $bikeId = null)
    {
        $bike = Bike::query()->find($bikeId) ?: new Bike;
        $people = Person::query()->get();
        return View::make("pages/edit-bike", compact("bike", "people"));
    }

    public function saveBike(Request $request, ?string $bikeId = null)
    {
        $bike = Bike::query()->find($bikeId) ?: new Bike;
        $bike
            ->fill($request->input())
            ->save();
        return Redirect::to("/bike/{$bike->id}");
    }
}
