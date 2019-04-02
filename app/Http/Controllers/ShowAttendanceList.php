<?php

namespace App\Http\Controllers;

use App;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Person;
use App\Views\Pages\AttendanceList;

class ShowAttendanceList extends Controller
{
    public function __invoke(Event $event)
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
        return new AttendanceList($event, $people, $attendance);
    }
}
