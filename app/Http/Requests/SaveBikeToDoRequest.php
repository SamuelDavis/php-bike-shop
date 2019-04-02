<?php

namespace App\Http\Requests;

use App\Models\BikeTodo;

/**
 * @property int completed_by_id
 * @property int confirmed_by_id
 */
class SaveBikeToDoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            BikeTodo::ATTR_DESCRIPTION => ["required"],
            BikeTodo::ATTR_COMPLETED_AT => [
                sprintf("required_with:%s,%s", BikeTodo::ATTR_COMPLETED_BY_ID, BikeTodo::ATTR_CONFIRMED_BY_ID)
            ],
            BikeTodo::ATTR_COMPLETED_BY_ID => [
                sprintf("required_with:%s,%s", BikeTodo::ATTR_COMPLETED_AT, BikeTodo::ATTR_CONFIRMED_BY_ID)
            ],
            BikeTodo::ATTR_CONFIRMED_BY_ID => [
                sprintf("required_with:%s,%s", BikeTodo::ATTR_COMPLETED_BY_ID, BikeTodo::ATTR_COMPLETED_AT)
            ],
        ];
    }
}
