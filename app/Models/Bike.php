<?php

namespace App\Models;

/**
 * @property string $description
 * @property float $value
 * @property string $notes
 * @property Person $source
 * @property Person|null $owner
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
}
