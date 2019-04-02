<?php

namespace App\Http\Requests;

use Illuminate\Support\Carbon;

/**
 * @property Carbon $from
 * @property Carbon $to
 */
class ListEventsRequest extends FormRequest
{
    public function getFromField(string $value = null)
    {
        return Carbon::parse($value ?: Carbon::now())->startOfDay();
    }

    public function getToField(string $value = null)
    {
        return Carbon::parse($value ?: Carbon::now())->endOfDay();
    }
}
