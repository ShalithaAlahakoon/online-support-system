<?php

namespace Domain\User\QueryBuilders;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template T of User
 *
 * @extends Builder<T>
 */
class UserQueryBuilder extends Builder
{
    /**
     * Add user filters
     */
    public function filters(): self
    {
        return $this
            ->orderBy('created_at', 'desc')
            ->with(['role', 'role.permissions', 'logs', 'logs.causer'])
            ->when(
                request('search'),
                fn ($query) => $query
                    ->where('name', 'LIKE', '%'.request('search').'%')
                    ->orWhere('email', 'LIKE', '%'.request('search').'%')
                    ->orWhereHas('role', fn ($query) => $query->where('name', 'LIKE', '%'.request('search').'%'))
            )->when(
                request('entries'),
                fn ($query) => $query->limit(request('entries'))
            );
    }

    /**
     * Add role filters
     */
    public function whereRole(): self
    {
        $search = request('search');

        return $this->with(['role', 'role.permissions', 'logs', 'logs.causer'])->orderBy('updated_at', 'desc')->whereHas('role', function ($query) {
            $query->where('name', request('role_name') ?? 'Instructor');
        })->where(function ($query) use ($search) {
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                });
            }
        });
    }
}
