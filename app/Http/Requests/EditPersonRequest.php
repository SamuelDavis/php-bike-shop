<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;

class EditPersonRequest extends FormRequest
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