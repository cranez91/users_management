<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:10',
            'age' => 'nullable|integer|min:1|max:100',
            'photo' => 'nullable|string|max:100',
            'admission_date' => 'nullable|date_format:Y-m-d H:i:s'
        ];
    }
}
