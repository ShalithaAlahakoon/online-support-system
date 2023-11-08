<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed', 'min:8', 'max:8',
            function ($attribute, $value, $fail) {
                if (! preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $value)) {
                    $fail("The $attribute must contain at least one special character.");
                }
            },
            function ($attribute, $value, $fail) {
                if (! preg_match('/\d/', $value)) {
                    $fail("The $attribute must contain at least one integer.");
                }
            },
            function ($attribute, $value, $fail) {
                if (! preg_match('/[a-z]/', $value)) {
                    $fail("The $attribute must contain at least one lowercase letter.");
                }
            },
            function ($attribute, $value, $fail) {
                if (! preg_match('/[A-Z]/', $value)) {
                    $fail("The $attribute must contain at least one uppercase letter.");
                }
            },
        ];
    }
}
