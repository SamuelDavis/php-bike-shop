<?php

namespace App\Http\Requests;

use App\Models\Bike;
use App\Models\Person;
use Illuminate\Validation\Rule;

class SaveBikeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Bike::ATTR_DESCRIPTION => ["required"],
            Bike::ATTR_SOURCE_ID => ["required", Rule::exists(Person::TABLE, Person::ATTR_ID)],
            Bike::ATTR_OWNER_ID => $this->{Bike::ATTR_OWNER_ID} === null
                ? []
                : [Rule::exists(Person::TABLE, Person::ATTR_ID)],
        ];
    }
}
