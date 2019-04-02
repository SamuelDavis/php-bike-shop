<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * @property Event $event
 * @property Person $person
 * @property Carbon $signed_in_at
 * @property Carbon $signed_out_at
 * @property string $total_time
 */
class Attendance extends Model
{
    public const TABLE = "attendance";

    const ATTR_EVENT_ID = "event_id";
    const ATTR_PERSON_ID = "person_id";
    const ATTR_SIGNED_IN_AT = "signed_in_at";
    const ATTR_SIGNED_OUT_AT = "signed_out_at";
    const RELATION_EVENT = "event";
    const RELATION_PERSON = "person";

    public $casts = [
        self::ATTR_SIGNED_IN_AT => "datetime",
        self::ATTR_SIGNED_OUT_AT => "datetime",
    ];

    public function event()
    {
        return $this->belongsTo(
            Event::class,
            static::ATTR_EVENT_ID,
            Event::ATTR_ID,
            static::RELATION_EVENT
        );
    }

    public function person()
    {
        return $this->belongsTo(
            Person::class,
            static::ATTR_PERSON_ID,
            Person::ATTR_ID,
            static::RELATION_PERSON
        );
    }

    public function getTotalTimeAttribute()
    {
        return $this->signed_out_at
            ? $this->signed_out_at->longAbsoluteDiffForHumans($this->signed_in_at)
            : null;
    }
}
