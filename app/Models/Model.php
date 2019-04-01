<?php

namespace App\Models;

use App\Builders\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;

/**
 * @method $this|static setAttribute($key, $value)
 * @method static Builder query()
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    const TABLE = null;
    const ATTR_ID = "id";
    const ATTR_CREATED_AT = "created_at";
    const ATTR_UPDATED_AT = "updated_at";

    protected static $builder = Builder::class;

    public function __construct(array $attributes = [])
    {
        $this->casts += [
            self::ATTR_CREATED_AT => 'datetime',
            self::ATTR_UPDATED_AT => 'datetime',
        ];
        $this
            ->setTable(static::TABLE)
            ->fillable(static
                ::enum('ATTR_')
                ->diff(self::enum())
                ->toArray()
            );
        parent::__construct($attributes);
    }

    public static function enum(?string $prefix = 'ENUM_'): Collection
    {
        static $values = [];

        try {
            return $values[$prefix] ?? $values[$prefix] = Collection
                    ::make((new ReflectionClass(static::class))->getConstants())
                    ->filter(function ($_value, string $key) use ($prefix) {
                        return $prefix === null || strpos($key, $prefix) === 0;
                    });
        } catch (ReflectionException $e) {
            return $values[$prefix] = Collection::make();
        }
    }

    /**
     * @param array $options
     * @return Model|$this|bool
     */
    public function save(array $options = [])
    {
        return parent::save($options) ? $this : false;
    }

    public function setRelations(array $relations)
    {
        foreach ($relations as $relation => $value) {
            $this->setRelation($relation, $value);
        }
        return $this;
    }

    public function setRelation($relation, $value)
    {
        $relationship = $this->{$relation}();
        if ($relationship instanceof BelongsTo) {
            $this->{$relationship->getForeignKeyName()} = $value->{$relationship->getOwnerKeyName()};
        }
        return parent::setRelation($relation, $value);
    }

    public function newEloquentBuilder($query)
    {
        return new static::$builder($query);
    }
}