<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use function sprintf;

/**
 * @property string $name
 * @property string $description
 * @property string $address
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property string $timeRange
 *
 * @property Person[]|Collection $people
 */
class Event extends Model
{
    public const TABLE = "events";

    const ATTR_NAME = "name";
    const ATTR_DESCRIPTION = "description";
    const ATTR_ADDRESS = "address";
    const ATTR_STARTS_AT = "starts_at";
    const ATTR_ENDS_AT = "ends_at";

    public $incrementing = false;

    public $casts = [
        self::ATTR_STARTS_AT => "datetime",
        self::ATTR_ENDS_AT => "datetime",
    ];

    public function people()
    {
        return $this
            ->hasManyThrough(
                Person::class,
                Attendance::class,
                Attendance::ATTR_EVENT_ID,
                Person::ATTR_ID,
                static::ATTR_ID,
                Attendance::ATTR_PERSON_ID
            )
            ->whereNull(Attendance::ATTR_SIGNED_OUT_AT);
    }

    public function getTimeRangeAttribute()
    {
        return sprintf(
            "%s - %s",
            $this->starts_at->format("M d, h:i a"),
            $this->ends_at->format("M d, h:i a")
        );
    }
}
