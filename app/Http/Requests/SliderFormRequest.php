<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use  Illuminate\Validation\Validator;

class SliderFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>[
                'required',
                'string',
            ],
            'description'=>[
                'required',
                'string',
            ],
            'image'=>[
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp'
            ],
            'status'=>[
                'nullable',
            ],
        ];
    }
}
