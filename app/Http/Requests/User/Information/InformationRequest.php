<?php

namespace App\Http\Requests\User\Information;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'company_name' => ['nullable', 'min:3', 'max:150'],
            'address' => ['nullable', 'min:3', 'max:255'],
            'address2' => ['nullable', 'min:3', 'max:255'],
            'city' => ['required', 'min:3', 'max:255'],
            'country' => ['nullable', 'exists:countries,name'],
            'state_province' => ['nullable'],
            'zip_postal_code' => ['required'],
            'phone' => ['nullable', 'min:3', 'max:16'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
