<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarsRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'weight' =>'nullable|numeric|between:0,99999999999.99',
            'sku' => 'required|max:255|unique:cars,sku,' . $id,
            // 'store_id'=>'required'
        ];
    }
}
