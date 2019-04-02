<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property Carbon $dob
 */
class Person extends Model
{
    public const TABLE = "people";

    const ATTR_NAME = "name";
    const ATTR_EMAIL = "email";
    const ATTR_ADDRESS = "address";
    const ATTR_PHONE = "phone";
    const ATTR_DOB = "dob";

    public $casts = [
        self::ATTR_DOB => "datetime",
    ];
}
