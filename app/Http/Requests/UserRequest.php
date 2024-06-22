<?php
namespace App\Http\Requests;

class UserRequest extends ApiResponse
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'string|max:255',
            'lastname' => 'string|max:255',
            'phone' => ['required', 'regex:/^(?:\+98|098|0|0098)?9\d{9}$/'],
        ];
    }

    public function messages()
    {
        return [
            'firstname.string' => 'The first name must be a text value.',
            'firstname.max' => 'The first name may not be longer than 255 characters.',
            'lastname.string' => 'The first name must be a text value.',
            'lastname.max' => 'The last name may not be longer than 255 characters.',
            'phone.required' => 'The phone number field is required.',
            'phone.regex' => 'The phone number format is invalid.',
        ];
    }

}