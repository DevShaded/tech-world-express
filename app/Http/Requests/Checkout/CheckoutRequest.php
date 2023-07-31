<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content_list' => ['required', 'array'],
            'user_id' => ['required', 'exists:users,id'],
            'email' => ['required', 'email'],
            'first_name' => ['required', 'string', 'max:30', 'min:2'],
            'last_name' => ['required', 'string', 'max:30', 'min:2'],
            'company_name' => ['nullable', 'string', 'max:30', 'min:2'],
            'address' => ['required', 'string', 'max:255', 'min:2'],
            'address2' => ['nullable', 'string', 'max:255', 'min:2'],
            'city' => ['required', 'string', 'max:30', 'min:2'],
            'country' => ['required', 'exists:countries,name'],
            'state_province' => ['required', 'string', 'max:30', 'min:2'],
            'zip_postal_code' => ['required', 'string', 'max:30', 'min:2'],
            'phone' => ['required', 'string', 'max:50', 'min:2'],
            'card_number' => ['required', 'numeric', 'digits_between:16,16'],
            'card_name' => ['required', 'string', 'max:30', 'min:2'],
            'card_expiry' => ['required', 'string', 'regex:^[0-9]{2}/[0-9]{2}$^'],
            'card_cvv' => ['required', 'string', 'regex:^[0-9]{3,4}$^'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
