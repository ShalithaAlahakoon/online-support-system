<?php

namespace Domain\User\Actions;

use App\Http\Resources\UserResource;
use Domain\User\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Domain\User\DataTransferObjects\UserFormData;

class UpdateUserAction
{
    /**
     * Update user action.
     *
     * @param UserFormData $userFormData
     * @param User $user
     * @return UserResource
     * @throws Exception
     */
    public function __invoke(UserFormData $userFormData, User $user): UserResource
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user->update([
                'fname' => $userFormData->firstName,
                'lname' => $userFormData->lastName,
                'name' => $userFormData->name,
                'email' => $userFormData->email,
                'password' => bcrypt($userFormData->password),
                'role_id' => $userFormData->roleId,
                'phone_number' => $userFormData->phoneNumber,
                'postal_address' => $userFormData->postalAddress,
                'status' => $userFormData->status,
                'country_id' => $userFormData->countryId,
                'about_me' => $userFormData->aboutMe,
            ]);

            if (isset($userFormData->photo)) {
                $user->updateProfilePhoto($userFormData->photo);
            }

            if ($userFormData->roleId){
                $user->syncRoles($userFormData->roleId);
            }

            DB::commit();

            return new UserResource($user);
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
