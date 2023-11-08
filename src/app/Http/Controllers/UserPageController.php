<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\UserFormRequest;
use Domain\MasterSettings\Models\Country;
use Domain\User\Actions\CreateUserAction;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Actions\UpdateUserAction;
use Domain\User\DataTransferObjects\UserFormData;
use Domain\User\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class UserPageController extends Controller
{
    use PasswordValidationRules;

    /**
     * Show the general users information screen.
     */
    public function index(Request $request)
    {
        return Jetstream::inertia()->render($request, 'User/Index', [
            'users' => User::query()->filters()->paginate(request('entries') ?? 10)->appends($request->except('page')),
            'requestParam' => $request->all() ?? null,
        ]);
    }

    /**
     * Show the create user information screen.
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            'roles' => Role::query()->get(),
        ]);
    }

    /**
     * Store a newly created user resource in storage.
     */
    public function store(
        UserFormRequest $userFormRequest,
        CreateUserAction $createUserAction
    ): Response {
        try {
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
                    countryId: $userFormRequest->country_id,
                    aboutMe: $userFormRequest->about_me,
                )
            );

            return Jetstream::inertia()->render($userFormRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'message' => 'User successfully created.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($userFormRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Show the edit user information screen.
     */
    public function edit(User $user): Response
    {
        return Jetstream::inertia()->render(request(), 'User/Edit', [
            'user' => $user,
            'roles' => Role::query()->get(),
        ]);
    }

    /**
     * Show the edit user information screen.
     */
    public function show(User $user): Response
    {
        return Jetstream::inertia()->render(request(), 'User/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the log user information screen.
     */
    public function logShow(User $user): Response
    {
        return Jetstream::inertia()->render(request(), 'User/Log', [
            'logs' => $user->logs,
        ]);
    }

    /**
     * Login into system as user.
     */
    public function loginAsUser(User $user): RedirectResponse
    {
        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    /**
     * Admin change user password.
     */
    public function adminChangePassword(
        AdminChangePasswordRequest $adminChangePasswordRequest,
        User $user
    ): Response {
        try {
            $user->update([
                'password' => bcrypt($adminChangePasswordRequest->password),
            ]);

            return Jetstream::inertia()->render($adminChangePasswordRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(request('entries') ?? 10),
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($adminChangePasswordRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(request('entries') ?? 10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Update User.
     */
    public function update(
        UserFormRequest $userFormRequest,
        UpdateUserAction $updateUserAction,
        User $user
    ): Response {
        try {
            $updateUserAction(
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
                    countryId: $userFormRequest->country_id,
                    aboutMe: $userFormRequest->about_me,
                ),
                $user
            );

            return Jetstream::inertia()->render($userFormRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'message' => 'User successfully updated.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($userFormRequest, 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Delete a user
     */
    public function destroy(DeleteUserAction $deleteUserAction, User $user): Response
    {
        try {
            $deleteUserAction($user);

            return Jetstream::inertia()->render(request(), 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'message' => 'User successfully deleted.',
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render(request(), 'User/Index', [
                'users' => User::query()->filters()->paginate(10),
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     *  Delete image for user
     *
     * @return void|Response
     */
    public function imageDestroy(User $user): Response
    {
        try {
            if (is_null($user->profile_photo_path)) {
                return Jetstream::inertia()->render(request(), 'User/Edit', [
                    'user' => $user,
                    'roles' => Role::query()->get(),
                    'countries' => Country::query()->get(),
                    'error' => 'Not found a photo path',
                ]);
            }

            Storage::disk(isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public'))->delete($user->profile_photo_path);

            $user->update(['profile_photo_path' => null]);

            return Jetstream::inertia()->render(request(), 'User/Edit', [
                'user' => $user,
                'roles' => Role::query()->get(),
                'countries' => Country::query()->get(),
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render(request(), 'User/Edit', [
                'user' => $user,
                'roles' => Role::query()->get(),
                'countries' => Country::query()->get(),
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
