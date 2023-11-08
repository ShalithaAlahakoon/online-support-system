<?php

namespace App\Http\Requests;

use App\Rules\DifferentPassword;
use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
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
            //            'password' => ['required', 'required_with:password_confirmation', 'min:8', 'max:8', 'same:password_confirmation', new DifferentPassword($this->user['id']),
            //                function ($attribute, $value, $fail) {
            //                    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
            //                        $fail("The $attribute must contain at least one special character.");
            //                    }
            //                },
            //                function ($attribute, $value, $fail) {
            //                    if (!preg_match('/\d/', $value)) {
            //                        $fail("The $attribute must contain at least one integer.");
            //                    }
            //                },
            //                function ($attribute, $value, $fail) {
            //                    if (!preg_match('/[a-z]/', $value)) {
            //                        $fail("The $attribute must contain at least one lowercase letter.");
            //                    }
            //                },
            //                function ($attribute, $value, $fail) {
            //                    if (!preg_match('/[A-Z]/', $value)) {
            //                        $fail("The $attribute must contain at least one uppercase letter.");
            //                    }
            //                }],
            //            'password_confirmation' => ['required', 'min:8', 'max:8'],
            'user' => ['required'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'user.required' => 'User is required.',
        ];
    }
}
