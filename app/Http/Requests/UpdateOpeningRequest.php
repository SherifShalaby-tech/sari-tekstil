<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpeningRequest extends FormRequest
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
        $id = $this->input('id');
        return [
            'name' => 'required|string|max:255|unique:openings,name,'.$id.',id,deleted_at,NULL',
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
