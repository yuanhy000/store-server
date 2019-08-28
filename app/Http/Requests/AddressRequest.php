<?php

namespace App\Http\Requests;

use App\Rules\NotEmpty;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => ['required', new NotEmpty],
            'mobile' => ['required', new NotEmpty],
            'province' => ['required', new NotEmpty],
            'city' => ['required', new NotEmpty],
            'county' => ['required', new NotEmpty],
            'detail' => ['required', new NotEmpty],
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
