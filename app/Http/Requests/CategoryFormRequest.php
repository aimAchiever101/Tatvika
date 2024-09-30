<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // change false to true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // need to make sure every of these fields are input fields 
        return [
            'name' => [
                'required',
                'string'
            ],
            'slug' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
            ],
            'image'=>[
                'nullable',
                'mimes:jpg,jpeg,png,webp'
            ],
            'meta_title' => [
                'required',
                'string'
            ],
            'meta_keyword' =>[
                'required',
                'string'
            ],
            'meta_description' => [
                'required',
                'string'
            ],
        ];
    }
}
