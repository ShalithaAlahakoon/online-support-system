<?php

namespace Domain\User\Actions;

use App\Http\Resources\UserResource;
use Domain\User\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Domain\User\DataTransferObjects\UserFormData;

class CreateUserAction
{
    /**
     * Store user action.
     *
     * @param UserFormData $userFormData
     * @return UserResource
     * @throws Exception
     */
    public function __invoke(UserFormData $userFormData): UserResource
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = User::create([
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
                $user->assignRole($userFormData->roleId);
            }

            DB::commit();

            return new UserResource($user);
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
