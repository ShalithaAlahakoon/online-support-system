<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordCountRule implements Rule
{
    private $min;
    private $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passes($attribute, $value)
    {
        $wordCount = str_word_count($value);
        return $wordCount >= $this->min && $wordCount <= $this->max;
    }

    public function message()
    {
        return "The :attribute must have between {$this->min} and {$this->max} words and :attribute can not contain only numbers and symbols";
    }
}
