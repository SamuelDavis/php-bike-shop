<?php

namespace App\Views\Pages\Admin;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Person;
use App\Views\ViewModel;
use Carbon\Carbon;

class EventAttendanceTable extends ViewModel
{
    public $event;
    public $copyEmails;

    public function __construct(Event $event)
    {
        parent::__construct();
        $this->event = $event;
        $this->copyEmails = $event->attendance
            ->pluck(Attendance::RELATION_PERSON)
            ->pluck(Person::ATTR_EMAIL)
            ->filter()
            ->unique()
            ->join(",");
    }

    public function totalPeople(): string
    {
        return $this->event->attendance->unique(Attendance::ATTR_PERSON_ID)->count() . " people";
    }

    public function totalTime(): string
    {
        $totalMinutes = $this->event->attendance->sum(function (Attendance $attendance) {
            return $attendance->signed_out_at
                ? $attendance->signed_in_at->diffInMinutes($attendance->signed_out_at)
                : 0;
        });
        return Carbon::now()->longAbsoluteDiffForHumans(Carbon::now()->addMinutes($totalMinutes));
    }
}