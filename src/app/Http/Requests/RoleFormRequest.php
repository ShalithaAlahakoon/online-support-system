<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
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
        if (request()->isMethod('POST')){
            $rules = [
                'name' => ['required', 'unique:roles'],
                'status' => ['required'],
                'description' => ['required'],
            ];
        }else{
            $rules = [
                'name' => ['required'],
                'status' => ['required'],
                'description' => ['required'],
            ];
        }
       return $rules;
    }
}
