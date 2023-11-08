<?php

namespace Domain\User\Actions;

use App\Http\Resources\RoleResource;
use Domain\User\DataTransferObjects\RoleFormData;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    /**
     * Store role action.
     *
     * @param RoleFormData $roleFormData
     * @return RoleResource
     * @throws Exception
     */
    public function __invoke(RoleFormData $roleFormData): RoleResource
    {
        try {
            DB::beginTransaction();

            /** @var Role $role */
            $role = Role::create([
                'name' => $roleFormData->name,
                'status' => $roleFormData->status,
                'description' => $roleFormData->description,
                'guard_name' => $roleFormData->guardName,
            ]);

            $role->givePermissionTo($roleFormData->permissions);

            DB::commit();
            return new RoleResource($role);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
