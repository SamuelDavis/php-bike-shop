<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * @property string $description
 * @property Carbon $completedAt
 * @property Bike $bike
 * @property Person|null $completedBy
 * @property Person|null $confirmedBy
 */
class BikeTodo extends Model
{
    public const TABLE = "bike_todos";

    const ATTR_DESCRIPTION = "description";
    const ATTR_COMPLETED_AT = "completed_at";
    const ATTR_BIKE_ID = "bike_id";
    const ATTR_COMPLETED_BY_ID = "completed_by_id";
    const ATTR_CONFIRMED_BY_ID = "confirmed_by_id";
    const RELATION_BIKE = "bike";
    const RELATION_COMPLETED_BY = "completedBy";
    const RELATION_CONFIRMED_BY = "confirmedBy";

    public $casts = [
        self::ATTR_COMPLETED_AT => "datetime",
    ];

    public function bike()
    {
        return $this->belongsTo(
            Bike::class,
            static::ATTR_BIKE_ID,
            Bike::ATTR_ID,
            static::RELATION_BIKE
        );
    }

    public function completedBy()
    {
        return $this->belongsTo(
            Person::class,
            static::ATTR_COMPLETED_BY_ID,
            Person::ATTR_ID,
            static::RELATION_COMPLETED_BY
        );
    }

    public function confirmedBy()
    {
        return $this->belongsTo(
            Person::class,
            static::ATTR_CONFIRMED_BY_ID,
            Person::ATTR_ID,
            static::RELATION_CONFIRMED_BY
        );
    }
}
