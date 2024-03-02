<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            // 'name'    => ['string', 'max:50'], // 氏名 任意,50文字以内
            // 'email' => ['required', 'email', 'max:255'], // メールアドレス:必須,255文字以内
            'message' => ['required', 'string', 'max:255'],  // 必須,255文字以内
        ];
    }
}
