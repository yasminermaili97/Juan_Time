<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateWatchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'model' => 'required|string|max:255',
           'brand' => 'required|string|max:255',
           'type_id' => 'required|string|max:255',
           'strap_id' => 'required|string|max:255',
           'year_edition' => 'required|numeric|min:0',
           'ean' => 'required|string|max:30',
           'price' => 'required|numeric|min:0'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(ApiResponse::error($validator->errors()
        , "Error Validation", 422));
    }


}
