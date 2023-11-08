<?php

namespace App\Actions\Fortify;

use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $validator = Validator::make($input, [
            'fname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
            'lname' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[^0-9]+$/i', 'regex:/^[a-zA-Z\s]+$/i'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ]);

        $validator->setCustomMessages([
            'fname.min' => 'Name is too short',
            'lname.min' => 'Name is too short',
            'fname.regex' => 'First name should only contain alphabetic characters.',
            'lname.regex' => 'Last name should only contain alphabetic characters.',
        ]);


        $validator->validate();

        return User::create([
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'name' => $input['name'],
            'email' => $input['email'],
            'status' => 1,
            'created_by' => 'NON-Admin',
            'password' => Hash::make($input['password']),
        ]);
    }
}
