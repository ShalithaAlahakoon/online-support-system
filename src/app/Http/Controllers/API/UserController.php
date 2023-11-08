<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DataTransferObjects\UserFormData;
use Domain\User\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @return null
     */
    public function index()
    {
        return response()->json([
            'users' => User::query()
                ->filters()
                ->paginate(request('entries') ?? 10),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created user resource in storage.
     */
    public function store(
        UserFormRequest $userFormRequest,
        CreateUserAction $createUserAction
    ): JsonResponse {
        try {
            return response()->json(
                $createUserAction(
                    new UserFormData(
                        firstName: $userFormRequest->fname,
                        lastName: $userFormRequest->lname,
                        name: $userFormRequest->name,
                        email: $userFormRequest->email,
                        password: $userFormRequest->password,
                        roleId: $userFormRequest->role_id,
                        phoneNumber: $userFormRequest->phone_number,
                        photo: $userFormRequest->photo,
                        postalAddress: $userFormRequest->postal_address,
                        status: $userFormRequest->status,
                        country: $userFormRequest->country,
                        aboutMe: $userFormRequest->about_me,
                    )
                ),
                Response::HTTP_CREATED
            );
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
