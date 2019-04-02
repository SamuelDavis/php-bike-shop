<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * @property string $description
 * @property float $value
 * @property string $notes
 * @property int $source_id
 * @property int $owner_id
 * @property Person $source
 * @property Person|null $owner
 * @property BikeTodo[]|Collection $todos
 */
class Bike extends Model
{
    public const TABLE = "bikes";

    const ATTR_DESCRIPTION = "description";
    const ATTR_VALUE = "value";
    const ATTR_NOTES = "notes";
    const ATTR_SOURCE_ID = "source_id";
    const ATTR_OWNER_ID = "owner_id";

    const RELATION_SOURCE = "source";
    const RELATION_OWNER = "owner";

    public function source()
    {
        return $this->belongsTo(
            Person::class,
            static::ATTR_SOURCE_ID,
            Person::ATTR_ID,
            static::RELATION_SOURCE
        );
    }

    public function owner()
    {
        return $this->belongsTo(
            Person::class,
            static::ATTR_OWNER_ID,
            Person::ATTR_ID,
            static::RELATION_OWNER
        );
    }

    public function todos()
    {
        return $this
            ->hasMany(
                BikeTodo::class,
                BikeTodo::ATTR_BIKE_ID,
                static::ATTR_ID
            )
            ->orderBy(BikeTodo::ATTR_COMPLETED_AT);
    }
}
