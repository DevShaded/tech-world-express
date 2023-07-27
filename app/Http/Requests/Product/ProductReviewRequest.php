<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'user_id' => ['required', 'exists:users,id'],
            'category_name' => ['required', 'exists:categories,name'],
            'content' => ['required', 'min:10', 'max:500'],
            'rating' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
