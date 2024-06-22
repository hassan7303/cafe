<?php
namespace App\Http\Requests;

use App\Helpers\Helpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponse extends FormRequest
{
    protected $prefix = '40';
    protected function failedValidation(Validator $validator)
    {
        $error = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            Helpers::error($error, $this->prefix . '01')
        );
        parent::failedValidation($validator);
    }
}