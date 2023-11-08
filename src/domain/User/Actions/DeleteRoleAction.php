<?php

namespace Domain\User\Actions;

use Domain\User\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteRoleAction
{
    /**
     * Delete user action.
     *
     * @return bool
     */
    public function __invoke(Role $role)
    {
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
