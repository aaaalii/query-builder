<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UpperCase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(strtoupper($value) !== $value){
            $fail(':attribute must be upper case');
        }
    }
}
