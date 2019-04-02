<?php

namespace App\Http\Requests;

use App\Models\Bike;
use App\Models\Person;
use Illuminate\Validation\Rule;

class EditBikeRequest extends FormRequest
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
            Bike::ATTR_OWNER_ID => ["required", Rule::exists(Person::TABLE, Person::ATTR_ID)],
        ];
    }
}
