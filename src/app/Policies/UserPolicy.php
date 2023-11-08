<?php

namespace App\Policies;

use Domain\User\Models\User;

class UserPolicy
{
    /**
     * @return true
     */
    public function uploadFiles(User $user): bool
    {
        return true;
    }
}
