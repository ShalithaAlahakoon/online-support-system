<?php

namespace Domain\User\Actions;

use App\Http\Resources\RoleResource;
use Domain\User\DataTransferObjects\RoleFormData;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    /**
     * Update role action.
     *
     * @throws Exception
     */
    public function __invoke(RoleFormData $roleFormData, Role $role): RoleResource
    {
        try {
            DB::beginTransaction();

            /** @var Role $role */
            $role->update([
                'name' => $roleFormData->name,
                'status' => $roleFormData->status,
                'description' => $roleFormData->description,
                'guard_name' => $roleFormData->guardName,
            ]);

            $role->syncPermissions($roleFormData->permissions);

            DB::commit();

            return new RoleResource($role);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
