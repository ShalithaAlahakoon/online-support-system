<?php

namespace Domain\User\Actions;

use Domain\User\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteUserAction
{
    /**
     * Delete user action.
     *
     * @return true
     */
    public function __invoke(User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
