<?php

namespace App\Policies;

use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * @param User $user
     * @return true
     */
    public function uploadFiles(User $user): bool
    {
        return true;
    }
}
