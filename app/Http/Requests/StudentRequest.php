<?php

namespace App\Http\Requests;

use App\Rules\UpperCase;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StudentRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'name' => ['required', new UpperCase],
            'email' => 'required|email',
            'age' => ['required', 'numeric',
                        function(string $attribute, int $value, Closure $fail): void {
                            if($value < 90){
                                $fail(':attribute must be greater than 90');
                            }
                    }],
        ];
    }

    // method overriding
    public function messages()
    {
        return [
            'name.required' => 'Username is required!!!!',
            'email.email' => ':attribute is not valid'
        ];
    }

    // method overriding
    public function attributes()
    {
        return [
            'age' => 'AGE'
        ];
    }

    protected function prepareForValidation(): void
    {
        // $this->merge([
        //     'name' => strtoupper($this->name)
        // ]);
    }
}
