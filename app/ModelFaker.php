<?php

namespace App;

use App\Models\Attendance;
use App\Models\Bike;
use App\Models\Event;
use App\Models\Person;
use Faker\Provider\Base;
use Illuminate\Support\Carbon;

class ModelFaker extends Base
{
    public function person()
    {
        return new Person([
            Person::ATTR_NAME => $this->generator->name,
            Person::ATTR_PHONE => $this->generator->phoneNumber,
            Person::ATTR_ADDRESS => $this->generator->address,
            Person::ATTR_DOB => Carbon::parse($this->generator->dateTime)
        ]);
    }

    public function event()
    {
        $startsAt = Carbon::parse($this->generator->dateTime);
        return new Event([
            Event::ATTR_ID => $this->generator->unique()->text,
            Event::ATTR_NAME => $this->generator->sentence,
            Event::ATTR_DESCRIPTION => $this->generator->sentences(3, true),
            Event::ATTR_ADDRESS => $this->generator->address,
            Event::ATTR_STARTS_AT => $startsAt,
            Event::ATTR_ENDS_AT => $startsAt->copy()->addMinutes($this->generator->randomDigit),
        ]);
    }

    public function attendance()
    {
        /** @var Event $event */
        $event = $this->generator->event;
        /** @var Person $person */
        $person = $this->generator->person;
        $signedInAt = Carbon::parse($this->generator->dateTime);
        return (new Attendance([
            Attendance::ATTR_EVENT_ID => $event->id,
            Attendance::ATTR_PERSON_ID => $person->id,
            Attendance::ATTR_SIGNED_IN_AT => $signedInAt,
            Attendance::ATTR_SIGNED_OUT_AT => $signedInAt->copy()->addMinutes($this->generator->randomDigit),
        ]))
            ->setRelations([
                Attendance::RELATION_EVENT => $event,
                Attendance::RELATION_PERSON => $person,
            ]);
    }

    public function bike()
    {
        /** @var Person $source */
        $source = $this->generator->person;
        /** @var Person $owner */
        $owner = $this->generator->boolean ? $this->generator->person : null;

        return (new Bike([
            Bike::ATTR_DESCRIPTION => $this->generator->sentence,
            Bike::ATTR_VALUE => $this->generator->randomFloat(2, 20, 100),
            Bike::ATTR_NOTES => $this->generator->text
        ]))
            ->setRelations([
                Bike::RELATION_SOURCE => $source,
                Bike::RELATION_OWNER => $owner,
            ]);
    }
}