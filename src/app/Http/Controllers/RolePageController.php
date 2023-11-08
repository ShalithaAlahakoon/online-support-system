<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
use Domain\User\Actions\CreateRoleAction;
use Domain\User\Actions\DeleteRoleAction;
use Domain\User\Actions\UpdateRoleAction;
use Domain\User\DataTransferObjects\RoleFormData;
use Domain\User\Models\Role;
use Domain\User\Models\Module;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

class RolePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Role/Index', [
            'roles' => Role::query()->filters()->paginate(request('entries') ?? 10)->appends($request->except('page')),
            'requestParam' => $request->all() ?? null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Role/Create', [
            'modules' => Module::query()->with('permissions')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param RoleFormRequest $roleFormRequest
     * @param CreateRoleAction $createRoleAction
     * @return Response
     */
    public function store(
        RoleFormRequest $roleFormRequest,
        CreateRoleAction $createRoleAction
    ): Response
    {
        try {
            $createRoleAction(
                new RoleFormData(
                    name: $roleFormRequest->name,
                    description: $roleFormRequest->description,
                    permissions: $roleFormRequest->permissions,
                    status: $roleFormRequest->status,
                    guardName: 'web'
                )
            );

            return Jetstream::inertia()->render($roleFormRequest, 'Role/Index', [
                'users' => Role::query()->paginate(10),
                'message' => 'Role successfully created.'
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($roleFormRequest, 'Role/Index', [
                'users' => Role::query()->paginate(10),
                'error' => $exception->getMessage()
            ]);
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
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        return Jetstream::inertia()->render(request(), 'Role/Edit', [
            'role' => $role,
            'modules' => Module::query()->with('permissions')->get(),
            'permissionIds' => $role->permissions->pluck('id')
        ]);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param RoleFormRequest $roleFormRequest
     * @param UpdateRoleAction $updateRoleAction
     * @param Role $role
     * @return Response
     */
    public function update(
        RoleFormRequest $roleFormRequest,
        UpdateRoleAction $updateRoleAction,
        Role $role
    )
    {
        try {
            $updateRoleAction(
                new RoleFormData(
                    name: $roleFormRequest->name,
                    description: $roleFormRequest->description,
                    permissions: $roleFormRequest->permissions,
                    status: $roleFormRequest->status,
                    guardName: 'web'
                ),
                $role
            );

            return Jetstream::inertia()->render($roleFormRequest, 'Role/Index', [
                'roles' => Role::query()->filters()->paginate(10),
                'message' => 'Role successfully updated.'
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render($roleFormRequest, 'User/Index', [
                'users' => Role::query()->filters()->paginate(10),
                'error' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRoleAction $deleteRoleAction, Role $role)
    {
        try {
            $deleteRoleAction($role);
            return Jetstream::inertia()->render(request(), 'Role/Index', [
                'roles' => Role::query()->filters()->paginate(10),
                'message' => 'Role successfully deleted.'
            ]);
        } catch (Exception $exception) {
            return Jetstream::inertia()->render(request(), 'User/Index', [
                'roles' => Role::query()->filters()->paginate(10),
                'error' => $exception->getMessage()
            ]);
        }
    }
}
