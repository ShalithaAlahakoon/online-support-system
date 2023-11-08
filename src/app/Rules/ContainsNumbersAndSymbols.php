<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContainsNumbersAndSymbols implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value contains both letters and at least one number or symbol
        $containsLetters = preg_match('/[a-zA-Z]/', $value) === 1;
        $containsNumbersOrSymbols = preg_match('/[0-9!@#$%^&*(),.?":{}|<>]/', $value) === 1;

        // Check if the value doesn't consist only of numbers or only of special characters
        $isNotOnlyNumbers = ! ctype_digit($value);
        $isNotOnlySymbols = ! ctype_punct($value);

        return $containsLetters || $containsNumbersOrSymbols || $isNotOnlyNumbers || $isNotOnlySymbols;
    }

    public function message()
    {
        return 'The :attribute should contain both letters and may include numbers or symbols in the middle or at the end.';
    }
}
