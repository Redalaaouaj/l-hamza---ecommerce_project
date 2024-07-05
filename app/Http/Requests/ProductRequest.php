<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:4',
            'description' => 'required|min:20',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required'
        ];
        if ($this->isMethod('put')) {
            $rules['delete_images.*'] = 'exists:product_images,id';
        }
    }
}
