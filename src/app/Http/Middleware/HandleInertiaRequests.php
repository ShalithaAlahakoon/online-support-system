<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'permissions' => $request->user() ? function () use ($request) {
                return [
                    'canViewDashboard' => $request->user()->hasPermissionTo('View dashboard'),
                    'canCreateUser' => $request->user()->hasPermissionTo('Create user'),
                    'canEditUser' => $request->user()->hasPermissionTo('Edit user'),
                    'canViewUser' => $request->user()->hasPermissionTo('View user'),
                    'canDeleteUser' => $request->user()->hasPermissionTo('Delete user'),
                ];
            } : null,

            'urlPrev' => function () {
                if (url()->previous() !== route('login') && url()->previous() !== '' && url()->previous() !== url()->current()) {
                    return url()->previous();
                } else {
                    return 'empty'; // used in javascript to disable back button behavior
                }
            },

            'baseURL' => function () {
                return env('APP_URL');
            },

            'assetURL' => function () {
                return env('ASSET_URL');
            },
        ]);
    }
}
