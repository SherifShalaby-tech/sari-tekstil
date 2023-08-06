<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:jobs,title,'.$id.',id,deleted_at,NULL',
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
