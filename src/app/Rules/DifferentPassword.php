<?php

namespace App\Rules;

use Domain\User\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DifferentPassword implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value): bool
    {
        $user = User::find($this->userId);

        return ! Hash::check($value, $user->password);
    }

    public function message(): string
    {
        return 'The new password must be different from your current password.';
    }
}
