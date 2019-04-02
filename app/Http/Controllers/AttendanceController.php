<?php

namespace App\Http\Controllers;

use App;
use App\Builders\Builder;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Person;
use Illuminate\Support\Carbon;
use Redirect;
use View;

class AttendanceController extends Controller
{
    public function showAttendance(Event $event)
    {
        $attendance = Attendance::query()
            ->where(Attendance::ATTR_EVENT_ID, $event->id)
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

    public function toggleAttendance(Event $event, Person $person)
    {
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
}
