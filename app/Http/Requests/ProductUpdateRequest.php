<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            "name"=>'string|max:255|min:3',
            "description"=>"string|max:255|min:3",
            "price"=>'integer',
            "img"=>'url',
            "discount"=>'integer',
            'categories'=>'array',
            'categories.*'=>'integer|exists:categories,id',
            'tags'=>'array',
            'tags.*'=>'integer|exists:tags,id',
        ];
    }
}
