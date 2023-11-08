<?php

namespace App\Http\Requests;

use App\Rules\DifferentPassword;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        $rules = [];
        if (request()->isMethod('POST')) {
            $rules = [
                'fname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
                'lname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'name' => ['required', 'string', 'min:3',],
                'password' => ['required', 'required_with:password_confirmation', 'min:8', 'max:8', 'same:password_confirmation',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
                            $fail("The $attribute must contain at least one special character.");
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/\d/', $value)) {
                            $fail("The $attribute must contain at least one integer.");
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/[a-z]/', $value)) {
                            $fail("The $attribute must contain at least one lowercase letter.");
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/[A-Z]/', $value)) {
                            $fail("The $attribute must contain at least one uppercase letter.");
                        }
                    }],
                'password_confirmation' => ['required', 'min:8', 'max:8'],
                'role_id' => ['required'],
                'phone_number' => ['required', 'regex:/^(\+\d{1,3}\s?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/'],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
                'postal_address' => ['required'],
                'status' => ['required'],
                'country_id' => ['required'],
            ];
        } elseif (request()->isMethod('PUT')) {
            $rules = [
                'fname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
                'lname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'name' => ['required', 'string', 'min:3'],
                'role_id' => ['required'],
                'phone_number' => ['required', 'regex:/^(\+\d{1,3}\s?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/'],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
                'postal_address' => ['required'],
                'status' => ['required'],
                'country_id' => ['required'],
            ];
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'fname.min' => 'Name is too short',
            'lname.min' => 'Name is too short',
            'fname.regex' => 'First name should only contain alphabetic characters.',
            'lname.regex' => 'Last name should only contain alphabetic characters.',
            'role_id.required' => 'Please select a role for user.',
            'email.required' => 'Email is required.',
            'email.unique' => 'The email address is already taken.',
            'email.email' => 'The email field must be a valid email address.',
            'password.required' => 'Password is required.',
            'password_confirmation.required' => 'Password confirmation is required.',
            'phone_number.required' => 'The phone field is required.',
            'phone_number.regex' => 'The phone field must be a valid phone number.',
            'photo.mimes' => 'The image must be in JPEG, PNG or JPG format.',
            'photo.max' => 'The image size should not exceed 1MB.',
            'postal_address.required' => 'The billing address field is required.',
            'status.required' => 'Please select a status for user.',
            'country_id.required' => 'The country field is required.',
        ];
    }
}
