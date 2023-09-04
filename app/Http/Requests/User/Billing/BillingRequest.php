<?php

namespace App\Http\Requests\User\Billing;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'card_number' => ['nullable', 'min:16', 'max:16'],
            'card_name' => ['nullable', 'min:3', 'max:255'],
            'card_expiry' => ['nullable', 'min:4', 'max:4'],
            'card_cvv' => ['nullable', 'min:3', 'max:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
