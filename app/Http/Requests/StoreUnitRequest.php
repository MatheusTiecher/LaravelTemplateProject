<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'social_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:units,cnpj',
            'email' => 'required|string|max:255|unique:units,email',
            'phone' => 'nullable|string|max:255',
            'cellphone' => 'required|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ];
    }
}
