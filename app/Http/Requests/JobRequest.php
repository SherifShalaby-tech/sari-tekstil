<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title' => 'required|max:255|unique:jobs,title,NULL,id,deleted_at,NULL',
        ];
    }
    public function messages()
    {
        return [
        'title.required'=>__('lang.NameRequired'),
        'title.unique'=>__('lang.NameUnique'),
        ];
    }
}
