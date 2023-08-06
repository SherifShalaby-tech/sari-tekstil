<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FillRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:fills,name,NULL,id,deleted_at,NULL',
        ];
    }
    public function messages()
    {
        return [
        'name.required'=>__('lang.NameRequired'),
        'name.unique'=>__('lang.NameUnique'),
        ];
    }
}
