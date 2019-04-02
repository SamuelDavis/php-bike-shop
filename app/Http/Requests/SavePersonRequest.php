<?php

namespace App\Http\Requests;

use App\Models\Person;

class SavePersonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Person::ATTR_NAME => ["required"],
        ];
    }
}
